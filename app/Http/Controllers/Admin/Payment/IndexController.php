<?php

namespace App\Http\Controllers\Admin\Payment;

use PDF;
use App\Models\Bank;
use App\Models\Agent;
use App\Models\Payment;
use App\Models\BankLedger;
use App\Models\AgentLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Common\ImageUpload;

class IndexController extends Controller
{
    use ImageUpload;

    public function index(){
    	$data['allData'] = Payment::with(['agent', 'bank'])->get();
    	return view('admin.payment.view',$data);
    }

    public function create(){
        $data['add'] = TRUE;
        $data['all_agents'] = Agent::query()
                            ->where('status',1)
                            ->pluck('name', 'id')
                            ->prepend('Please Select', '')
                            ->toArray();
        $data['all_banks'] = Bank::query()
                            ->where('id','!=',1)
                            ->pluck('bank_name', 'id')
                            ->prepend('Please Select', '')
                            ->toArray();
        return view('admin.payment.add', $data);
    }

    public function store(Request $request){

       $this->validate($request,[
            'transaction_date'  =>'required',
            'agent_id'          =>'required',
            'payment_mode'      =>'required',
            'amount'            =>'required',
            'money_receipt_no'  =>'required',
        ]);

        if($request->payment_mode == 'Cheque'){
            $this->validate($request,[
                'bank_id'      =>'required',
                'cheque_no'    =>'required',
                'cheque_date'  =>'required',
            ]);
        }

        return DB::transaction(function () use ($request) {

            $payment_mode = $request->payment_mode;
            $status = "Active";
            $bank_id = '';
            $cheque_no = '';
            $cheque_date = '';

            $data                     = new Payment();

            $imagePath      = 'admin/documents/';
            $imgFor = 'payment-';
            // Save Image 
            $current_image  = $request->file('image'); 
            if($current_image){
                $imgName= $this->imageUplaodByName($current_image, null, $imagePath, $imgFor); 
                $data->image = $imgName;
            }

            $data->transaction_date   = date('d-m-Y', strtotime($request->transaction_date));
            $data->agent_id           = $request->agent_id;

            if ($payment_mode == 'Cash') {
				$bank_id = '1';
			} else if ($payment_mode == 'Cheque') {
				$bank_id = $request->bank_id;
				$cheque_no = $request->cheque_no;
				$cheque_date = date('d-m-Y', strtotime($request->cheque_date));
			}
            
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
					$cash = Bank::where('id',1)->first();
					if ($request->amount > $cash->account_balance) {
						notify()->error(limit_crossed(),"Error","topRight");
						return redirect()->route('payment.index');
					}
				}

                // Update party balance
                //$this->db->query("UPDATE tbl_party SET balance=balance+'" . $amount . "' WHERE id='" . $party_id . "' ");
                // Create agent ledger
                $Aldata = array(
                    'id'               => make_id('agent_ledger', 'id', 'AL'),
                    'agent_id'         => $request->agent_id,
                    'billing_date'     => $request->transaction_date,
                    'transaction_type' => "Payment",
                    'reference_no'     => $data->id,
                    'amount'           => $request->amount,
                    'ledger_status'    => $status,
                );
                AgentLedger::insert($Aldata);
                
                // Update bank account balance
                Bank::where('id',$bank_id)
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
				
                notify()->success(saved_success(),"Success","topRight");

            }else{
                notify()->error(exception(),"Error","topRight");
            }

            return redirect()->route('payment.index');

        });

    }//store

    public function edit($id){
    	$data['edit'] = TRUE;
        $id = hashid_decode($id);
    	$data['single'] = Payment::findOrFail($id);
    	return view('admin.payment.add', $data);
    }

    public function update(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required|digits_between:11,14',
            'address'=>'required',
        ]);
       
        $data               = Payment::findOrFail($request->id);
        $data->name         = $request->name;
        $data->email        = $request->email;
        $data->phone        = $request->phone;
        $data->address      = $request->address;
        $success            = $data->save();

        if($success){
            notify()->success(updated_success(),"Success","topRight");
        }else{
            notify()->error(exception(),"Error","topRight");
        }
        return redirect()->route('payment.index');
        
    }//update


    public function particulars($reference_no = NULL) {
		$particular = $payment_mode = $money_receipt = $remarks =  '';
		
		$payment = Payment::with('bank')->find($reference_no);
		if ($payment->payment_mode == 'Cheque') {
			$payment_mode =  $payment->bank->bank_name. " A/C # ". $payment->bank->account_no." Issued Cheque  #". $payment->cheque_no;
		} else {
			$payment_mode = $payment->payment_mode;
		}
		
		if($payment->money_receipt_no) {
			$money_receipt = " {Money Receipt No #  ".$payment->money_receipt_no. " }";
		}
			
		if ($payment->remarks) {
			$remarks = "<i>[" . $payment->remarks . "]</i>";
		}
		
		return "<span style='font-size:11px'>" . $particular . $payment_mode. $money_receipt .  $remarks . "</span>";
	}

    public function report(){
        $data['title'] = 'Payment Report';
        $data['allData'] = Payment::with(['agent', 'bank'])->get();
        $pdf = PDF::loadHtml(view('admin.payment.report', $data));
        return $pdf->stream('payment-report'.date('m-d-Y').'.pdf');
        //$pdf = PDF::loadView('admin.payment.report', $data);
        //return view('admin.payment.report', $data);
        //return $pdf->stream('payment-report'.date('m-d-Y').'.pdf');
    }

    // destroy
    public function delete($id){

        dd('not done');
        
    }
    
}
