<?php

namespace App\Http\Controllers\Admin\Received;

use PDF;
use App\Models\Bank;
use App\Models\Agent;
use App\Models\Received;
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
    	$data['allData'] = Received::with(['agent', 'bank'])->get();
    	return view('admin.received.view',$data);
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
        return view('admin.received.add', $data);
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

            $data                    = new Received();

            $imagePath      = 'admin/documents/';
            $imgFor = 'received-';
            // Save Image 
            $current_image  = $request->file('image'); 
            if($current_image){
                $imgName= $this->imageUplaodByName($current_image, null, $imagePath, $imgFor); 
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
            $data->agent_id           = $request->agent_id;
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

                // Update agent balance
                Agent::where('id',$request->agent_id)
                    ->update([
                        'balance' => DB::raw('balance - ' . (int) $request->amount),
                    ]);

                // Create agent ledger
                $Aldata = array(
                    'id'               => make_id('agent_ledger', 'id', 'AL'),
                    'agent_id'         => $request->agent_id,
                    'billing_date'     => date('Y-m-d', strtotime($request->transaction_date)),
                    'transaction_type' => "Received",
                    'reference_no'     => $data->id,
                    'amount'           => $request->amount,
                    'ledger_status'    => $status,
                );
                AgentLedger::insert($Aldata);
                
                // Update bank account balance
                Bank::where('id',$bank_id)
                    ->update([
                        'account_balance' => DB::raw('account_balance + ' . (int) $request->amount),
                    ]);

                // Create bank ledger
                $Bldata = array(
                    'id'               => make_id('bank_ledger', 'id', 'BL'),
                    'bank_id'          => $bank_id,
                    'transaction_date' => $request->transaction_date,
                    'transaction_type' => "Received",
                    'reference_no'     => $data->id,
                    'amount'           => $request->amount,
                    'ledger_status'    => $status,
                );
                BankLedger::insert($Bldata);
				
                notify()->success(saved_success(),"Success","topRight");

            }else{
                notify()->error(exception(),"Error","topRight");
            }

            return redirect()->route('received.index');

        });

    }//store


    public function edit($id){
    	$data['edit'] = TRUE;
        $id = hashid_decode($id);
    	$data['single'] = Received::findOrFail($id);
    	return view('admin.received.add', $data);
    }

    public function update(Request $request){
        dd('yoo');
    }//update


    public function particulars($reference_no = NULL) {
		$particular = $payment_mode = $money_receipt = $remarks =  '';
		
		$payment = Received::with('bank')->find($reference_no);
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
        $data['title'] = 'Received Report';
        $data['allData'] = Received::with(['agent', 'bank'])->get();
        $pdf = PDF::loadHtml(view('admin.received.report', $data));
        return $pdf->stream('received-report'.date('m-d-Y').'.pdf');
    }

    public function invoice($received_id = NULL) {

        $id              = hashid_decode($received_id);
		$data['invoice'] = Received::with(['agent', 'bank'])->where('id',$id)->first();
		$payment = Received::with(['agent', 'bank'])->where('id',$id)->first();
		if($payment->payment_mode=='Cash') {
			$data['title'] = "Cash Received Info";
			$data['note'] = 'Cash';
			$data['note2'] = 'Cash';
		} else if($payment->payment_mode=='Cheque') {
			$data['title'] = "Bank Received Info";
			$data['note'] = $payment->bank->bank_name." <".$payment->bank->account_no.">";
			$data['note2'] = "";
		}
        $data['time'] = "Entry Time: " . date('d-m-Y h:i A', strtotime($data['invoice']->transaction_date))
        . "Print Time: " . date('d-m-Y h:i A');
        $data['by'] = "Print By: " . logged_in_user_name();

        $pdf = PDF::loadHtml(view('admin.received.invoice', $data));
        return $pdf->stream('received-invoice'.$id.date('m-d-Y').'.pdf');
	}

    // destroy
    public function delete($id){
        dd('not done');
    }
    
}
