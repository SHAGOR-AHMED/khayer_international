<?php

namespace App\Http\Controllers\Admin\Purchase;

use PDF;
use App\Models\Bank;
use App\Models\Agent;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\BankLedger;
use App\Models\AgentLedger;
use Illuminate\Http\Request;
use App\Models\PurchaseDetail;
use App\Models\SupplierLedger;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Common\ImageUpload;
use App\Models\Payment;

class IndexController extends Controller
{
    use ImageUpload;

    public function index()
    {
        $data['allData'] = Purchase::with(['supplier', 'bank'])->get();
        return view('admin.purchase.view', $data);
    }

    public function create()
    {
        $data['add'] = TRUE;
        $data['all_suppliers'] = Supplier::query()
            ->where('status', 1)
            ->where('type', 'FOREIGN')
            ->pluck('office_name', 'id')
            ->prepend('Please Select', '')
            ->toArray();
        $data['all_banks'] = Bank::query()
            ->where('id', '!=', 1)
            ->pluck('bank_name', 'id')
            ->prepend('Please Select', '')
            ->toArray();
        return view('admin.purchase.add', $data);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'transaction_date'  => 'required',
            'supplier_id'       => 'required',
            'money_receipt_no'  => 'nullable',
            'payment_mode'      => 'required',
            'amount'            => 'required',
        ]);

        if ($request->payment_mode == 'Cheque') {
            $this->validate($request, [
                'bank_id'      => 'required',
                'cheque_no'    => 'required',
                'cheque_date'  => 'required',
            ]);
        }

        return DB::transaction(function () use ($request) {

            $payment_mode = $request->payment_mode;
            $status = "Active";
            $bank_id = '';
            $cheque_no = '';
            $cheque_date = '';

            $data                    = new Purchase();

            $imagePath      = 'admin/documents/';
            $imgFor = 'purchase-';
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

                // Insert product details
                $pddata = array(
                    'purchase_id'       => $data->id,
                    'product_details'   => $request->product_details,
                    'product_quantity'  => $request->product_quantity,
                    'product_price'     => $request->product_price,
                );
                PurchaseDetail::insert($pddata);

                if ($bank_id == '1') {
                    // Check cash balance limitation
                    $cash = Bank::where('id', 1)->first();
                    if ($request->amount > $cash->account_balance) {
                        notify()->error(limit_crossed(), "Error", "topRight");
                        return redirect()->route('purchase.index');
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
                    'transaction_type' => "Purchase",
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
                    'transaction_type' => "Purchase",
                    'reference_no'     => $data->id,
                    'amount'           => $request->amount,
                    'ledger_status'    => $status,
                );
                BankLedger::insert($Bldata);

                notify()->success(saved_success(), "Success", "topRight");
            } else {
                notify()->error(exception(), "Error", "topRight");
            }

            return redirect()->route('purchase.index');
        });
    } //store


    public function particulars($reference_no = NULL)
    {
        $particular = $payment_mode = $money_receipt = $remarks =  '';

        $payment = Purchase::with(['supplier', 'bank'])->find($reference_no);
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
        $pdf = PDF::loadHtml(view('admin.purchase.report', $data));
        return $pdf->stream('payment-report' . date('m-d-Y') . '.pdf');
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
        $pdf = PDF::loadHtml(view('admin.purchase.invoice', $data));
        return $pdf->stream('payment-invoice' . $id . date('m-d-Y') . '.pdf');
    }
}
