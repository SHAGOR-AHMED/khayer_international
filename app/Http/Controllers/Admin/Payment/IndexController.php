<?php

namespace App\Http\Controllers\Admin\Payment;

use PDF;
use App\Models\Bank;
use App\Models\Agent;
use App\Models\Payment;
use App\Models\Supplier;
use App\Models\BankLedger;
use App\Models\AgentLedger;
use Illuminate\Http\Request;
use App\Models\SupplierLedger;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Common\ImageUpload;

class IndexController extends Controller
{
    use ImageUpload;

    public function index()
    {
        $data['allData'] = Payment::with(['supplier', 'bank'])->get();
        return view('admin.payment.view', $data);
    }

    public function create()
    {
        $data['add'] = TRUE;
        $data['all_suppliers'] = Supplier::query()
            ->where('status', 1)
            ->pluck('office_name', 'id')
            ->prepend('Please Select', '')
            ->toArray();
        $data['all_banks'] = Bank::query()
            ->where('id', '!=', 1)
            ->pluck('bank_name', 'id')
            ->prepend('Please Select', '')
            ->toArray();
        return view('admin.payment.add', $data);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'transaction_date'  => 'required',
            'supplier_id'       => 'required',
            'payment_mode'      => 'required',
            'amount'            => 'required',
            'money_receipt_no'  => 'required',
            'type'              => 'required',
        ]);

        if ($request->payment_mode == 'Cheque') {
            $this->validate($request, [
                'bank_id'      => 'required',
                'cheque_no'    => 'required',
                'cheque_date'  => 'required',
            ]);
        }

        if ($request->type == 'FOREIGN') {
            $this->validate($request, [
                'payrate'     => 'required',
                'bdamount'    => 'required',
            ]);
        }

        return DB::transaction(function () use ($request) {

            $payment_mode = $request->payment_mode;
            $status = "Active";
            $bank_id = '';
            $cheque_no = '';
            $cheque_date = '';

            $data                    = new Payment();

            $imagePath      = 'admin/documents/';
            $imgFor = 'payment-';
            // Save Image
            $current_image  = $request->file('image');
            if ($current_image) {
                $imgName = $this->imageUplaodByName($current_image, null, $imagePath, $imgFor);
                $data->image = $imgName;
            }

            if ($payment_mode == 'Cash') {
                $bank_id = '1';
            } else if ($payment_mode == 'Cheque') {
                $bank_id = $request->bank_id;
                $cheque_no = $request->cheque_no;
                $cheque_date = date('d-m-Y', strtotime($request->cheque_date));
            }

            $data->transaction_date   = date('d-m-Y', strtotime($request->transaction_date));
            $data->supplier_id        = $request->supplier_id;
            $data->payrate            = $request->payrate;
            $data->bdamount           = $request->bdamount;
            $data->amount             = $request->amount;
            $data->payment_mode       = $payment_mode;
            $data->bank_id            = $bank_id;
            $data->cheque_no          = $cheque_no;
            $data->cheque_date        = $cheque_date;
            $data->status             = $status;
            $data->money_receipt_no   = $request->money_receipt_no;
            $data->remarks            = $request->remarks;
            $data->created_by         = logged_in_user_id();
            $data->log                = logged_in_user_name() . "<br/>" .  $request->transaction_date;
            $success                  = $data->save();

            if ($success) {

                if ($bank_id == '1') {
                    // Check cash balance limitation
                    $cash = Bank::where('id', 1)->first();
                    if ($request->amount > $cash->account_balance) {
                        notify()->error(limit_crossed(), "Error", "topRight");
                        return redirect()->route('payment.index');
                    }
                }

                // Update supplier balance
                Supplier::where('id', $request->supplier_id)
                    ->update([
                        'balance' => DB::raw('balance + ' . (int) $request->amount),
                    ]);
                // Create supplier ledger
                $Aldata = array(
                    'id'               => make_id('supplier_ledger', 'id', 'SL'),
                    'supplier_id'      => $request->supplier_id,
                    'billing_date'     => $request->transaction_date,
                    'transaction_type' => "Payment",
                    'reference_no'     => $data->id,
                    'amount'           => $request->amount,
                    'ledger_status'    => $status,
                );
                SupplierLedger::insert($Aldata);

                // Update bank account balance
                Bank::where('id', $bank_id)
                    ->update([
                        'account_balance' => DB::raw('account_balance - ' . (int) $request->amount),
                    ]);
                // Create bank ledger
                $Bldata = array(
                    'id'               => make_id('bank_ledger', 'id', 'BL'),
                    'bank_id'          => $bank_id,
                    'transaction_date' => $request->transaction_date,
                    'transaction_type' => "Payment",
                    'reference_no'     => $data->id,
                    'amount'           => $request->amount,
                    'ledger_status'    => $status,
                );
                BankLedger::insert($Bldata);

                notify()->success(saved_success(), "Success", "topRight");
            } else {
                notify()->error(exception(), "Error", "topRight");
            }

            return redirect()->route('payment.index');
        });
    } //store

    public function edit($id)
    {
        $data['edit'] = TRUE;
        $id = hashid_decode($id);
        $data['single'] = Payment::findOrFail($id);
        $data['all_suppliers'] = Supplier::query()
            ->where('status', 1)
            ->pluck('office_name', 'id')
            ->prepend('Please Select', '')
            ->toArray();
        $data['all_banks'] = Bank::query()
            ->where('id', '!=', 1)
            ->pluck('bank_name', 'id')
            ->prepend('Please Select', '')
            ->toArray();
        return view('admin.payment.add', $data);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'transaction_date'  => 'required',
            'supplier_id'       => 'required',
            'payment_mode'      => 'required',
            'amount'            => 'required',
            'money_receipt_no'  => 'required',
            'type'              => 'required',
        ]);

        if ($request->payment_mode == 'Cheque') {
            $this->validate($request, [
                'bank_id'      => 'required',
                'cheque_no'    => 'required',
                'cheque_date'  => 'required',
            ]);
        }

        if ($request->type == 'FOREIGN') {
            $this->validate($request, [
                'payrate'     => 'required',
                'bdamount'    => 'required',
            ]);
        }

        return DB::transaction(function () use ($request) {

            $payment_mode = $request->payment_mode;
            $status = "Active";
            $bank_id = '';
            $cheque_no = '';
            $cheque_date = '';

            $data = Payment::findOrFail($request->id);
            $old_amount = $data->amount;
            $old_supplier_id = $data->supplier_id;
            $old_bank_id = $data->bank_id;

            $imagePath = 'admin/documents/';
            $imgFor = 'payment-';
            // Save Image
            $current_image = $request->file('image');
            if ($current_image) {
                $imgName = $this->imageUplaodByName($current_image, $data->image, $imagePath, $imgFor);
                $data->image = $imgName;
            }

            if ($payment_mode == 'Cash') {
                $bank_id = '1';
            } else if ($payment_mode == 'Cheque') {
                $bank_id = $request->bank_id;
                $cheque_no = $request->cheque_no;
                $cheque_date = date('d-m-Y', strtotime($request->cheque_date));
            }

            $data->transaction_date   = date('d-m-Y', strtotime($request->transaction_date));
            $data->supplier_id        = $request->supplier_id;
            $data->payrate            = $request->payrate;
            $data->bdamount           = $request->bdamount;
            $data->amount             = $request->amount;
            $data->payment_mode       = $payment_mode;
            $data->bank_id            = $bank_id;
            $data->cheque_no          = $cheque_no;
            $data->cheque_date        = $cheque_date;
            $data->status             = $status;
            $data->money_receipt_no   = $request->money_receipt_no;
            $data->remarks            = $request->remarks;
            $data->updated_by         = logged_in_user_id();
            $data->log                = $data->log . "<br/>" . logged_in_user_name() . " Updated on " . $request->transaction_date;
            $success                  = $data->save();

            if ($success) {

                if ($bank_id == '1') {
                    // Check cash balance limitation
                    $cash = Bank::where('id', 1)->first();
                    $amount_difference = $request->amount - $old_amount;
                    if ($amount_difference > $cash->account_balance) {
                        notify()->error(limit_crossed(), "Error", "topRight");
                        return redirect()->route('payment.index');
                    }
                }

                // Reverse old entries first
                // Update old supplier balance (subtract old amount)
                Supplier::where('id', $old_supplier_id)
                    ->update([
                        'balance' => DB::raw('balance - ' . (int) $old_amount),
                    ]);

                // Update old bank account balance (add old amount back)
                Bank::where('id', $old_bank_id)
                    ->update([
                        'account_balance' => DB::raw('account_balance + ' . (int) $old_amount),
                    ]);

                // Delete old ledger entries
                SupplierLedger::where('reference_no', $data->id)
                    ->where('transaction_type', 'Payment')
                    ->delete();

                BankLedger::where('reference_no', $data->id)
                    ->where('transaction_type', 'Payment')
                    ->delete();

                // Create new entries
                // Update supplier balance with new amount
                Supplier::where('id', $request->supplier_id)
                    ->update([
                        'balance' => DB::raw('balance + ' . (int) $request->amount),
                    ]);

                // Create new supplier ledger
                $Aldata = array(
                    'id'               => make_id('supplier_ledger', 'id', 'SL'),
                    'supplier_id'      => $request->supplier_id,
                    'billing_date'     => $request->transaction_date,
                    'transaction_type' => "Payment",
                    'reference_no'     => $data->id,
                    'amount'           => $request->amount,
                    'ledger_status'    => $status,
                );
                SupplierLedger::insert($Aldata);

                // Update bank account balance with new amount
                Bank::where('id', $bank_id)
                    ->update([
                        'account_balance' => DB::raw('account_balance - ' . (int) $request->amount),
                    ]);

                // Create new bank ledger
                $Bldata = array(
                    'id'               => make_id('bank_ledger', 'id', 'BL'),
                    'bank_id'          => $bank_id,
                    'transaction_date' => $request->transaction_date,
                    'transaction_type' => "Payment",
                    'reference_no'     => $data->id,
                    'amount'           => $request->amount,
                    'ledger_status'    => $status,
                );
                BankLedger::insert($Bldata);

                notify()->success(updated_success(), "Success", "topRight");
            } else {
                notify()->error(exception(), "Error", "topRight");
            }

            return redirect()->route('payment.index');
        });
    } //update


    public function particulars($reference_no = NULL)
    {
        $particular = $payment_mode = $money_receipt = $remarks =  '';

        $payment = Payment::with('bank')->find($reference_no);
        if ($payment->payment_mode == 'Cheque') {
            $payment_mode =  $payment->bank->bank_name . " A/C # " . $payment->bank->account_no . " Issued Cheque  #" . $payment->cheque_no;
        } else {
            $payment_mode = $payment->payment_mode;
        }

        if ($payment->money_receipt_no) {
            $money_receipt = " {Money Receipt No #  " . $payment->money_receipt_no . " }";
        }

        if ($payment->remarks) {
            $remarks = "<i>[" . $payment->remarks . "]</i>";
        }

        return "<span style='font-size:11px'>" . $particular . $payment_mode . $money_receipt .  $remarks . "</span>";
    }

    public function report()
    {
        $data['title'] = 'Payment Report';
        $data['allData'] = Payment::with(['supplier', 'bank'])->get();
        $pdf = PDF::loadHtml(view('admin.payment.report', $data));
        return $pdf->stream('payment-report' . date('m-d-Y') . '.pdf');
        //$pdf = PDF::loadView('admin.payment.report', $data);
        //return view('admin.payment.report', $data);
        //return $pdf->stream('payment-report'.date('m-d-Y').'.pdf');
    }

    public function invoice($payment_id = NULL)
    {

        $id = hashid_decode($payment_id);
        $data['invoice'] = Payment::with(['supplier', 'bank'])->where('id', $id)->first();
        $payment = Payment::with(['supplier', 'bank'])->where('id', $id)->first();
        if ($payment->payment_mode == 'Cash') {
            $data['title'] = "Cash Paid Info";
            $data['note'] = 'Cash';
            $data['note2'] = 'Cash';
        } else if ($payment->payment_mode == 'Cheque') {
            $data['title'] = "Bank Paid Info";
            $data['note'] = $payment->bank->bank_name . " <" . $payment->bank->account_no . ">";
            $data['note2'] = "";
        }
        $data['time'] = "Entry Time: " . date('d-m-Y h:i A', strtotime($data['invoice']->transaction_date))
            . "Print Time: " . date('d-m-Y h:i A');
        $data['by'] = "Print By: " . logged_in_user_name();

        $pdf = PDF::loadHtml(view('admin.payment.invoice', $data));
        return $pdf->stream('payment-invoice' . $id . date('m-d-Y') . '.pdf');
    }

    // destroy
    public function delete($id)
    {

        dd('not done');
    }
}
