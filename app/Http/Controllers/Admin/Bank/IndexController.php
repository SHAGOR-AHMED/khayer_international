<?php

namespace App\Http\Controllers\Admin\Bank;

use PDF;
use App\Models\Bank;
use App\Models\Payment;
use App\Models\BankLedger;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class IndexController extends Controller
{
    public function index(){
    	$data['allData'] = Bank::get();
    	return view('admin.bank.view',$data);
    }

    public function create(){
        $data['add'] = TRUE;
        return view('admin.bank.add', $data);
    }

    public function store(Request $request){

       $this->validate($request,[
            'bank_name'=>'required',
            'account_name'=>'required',
            'account_no'=>'required',
            'account_balance'=>'required',
        ]);

        return DB::transaction(function () use ($request) {

            // $bank_id = make_id('banks', 'id', 'BANK');

            $data                     = new Bank();
            // $data->id                 = $bank_id;
            $data->bank_name          = $request->bank_name;
            $data->account_name       = $request->account_name;
            $data->account_no         = $request->account_no;
            $data->account_balance    = $request->account_balance;
            $data->bank_remarks       = $request->bank_remarks;
            $data->created_by         = logged_in_user_id();
            $success                  = $data->save();

            if ($success) {
                // Create bank ledger
                $ledgerData = array(
                    'id' => make_id('bank_ledger', 'id', 'BL'),
                    'bank_id' => $data->id,
                    'transaction_date' => date('d-m-Y'),
                    'transaction_type' => "Initial Balance",
                    'amount' => $request->account_balance,
                    'ledger_status' => "Active",
                );

                BankLedger::insert($ledgerData);
            }

            if($success){
                notify()->success(saved_success(),"Success","topRight");
            }else{
                notify()->error(exception(),"Error","topRight");
            }
            return redirect()->route('bank.index');

        });

    }//store

    public function edit($id){
    	$data['edit'] = TRUE;
        $id = hashid_decode($id);
    	$data['single'] = Bank::findOrFail($id);
    	return view('admin.bank.add', $data);
    }

    public function update(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required|digits_between:11,14',
            'address'=>'required',
        ]);
       
        $data               = Bank::findOrFail($request->id);
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
        return redirect()->route('bank.index');
        
    }//update

    //control
    public function status($id){
        $id         = hashid_decode($id);
        $data       = Bank::findOrFail($id);
        if($data){
            $status = $data->bank_status;
            if($status == 'ACTIVE'){
                $data->bank_status = 'INACTIVE';
            }else{
                $data->bank_status = 'ACTIVE';
            }
            $success    =  $data->save();
            if($success){
                Alert::toast(updated_success(), 'info');
            }else{
                Alert::toast(exception(), 'error');
            }
            return redirect()->route('bank.index');
        }
    }

    public function ledger(){
        $data['all_banks'] = Bank::query()
                            ->where('bank_status','ACTIVE')
                            ->pluck('bank_name', 'id')
                            ->prepend('Please Select', '')
                            ->toArray();
    	return view('admin.bank.ledger',$data);
    }

    public function report(Request $request){

        $from_date = $request->date_range_from;
		$to_date = $request->date_range_to;
		$bank_id = $request->bank_id;

        $data['title'] = "Ledger Account";
		$data['bank'] = Bank::find($bank_id);
		$data['results'] = $this->ledger_report($from_date, $to_date, $bank_id);
		$data['from_date'] = $from_date;
		$data['to_date'] = $to_date;

        return view('admin.bank.ledger_report', $data);

        $pdf = PDF::loadHtml(view('admin.bank.ledger_report', $data));
        return $pdf->stream('ledger-report'.date('m-d-Y').'.pdf');
    }

    public function ledger_report($from_date = NULL, $to_date=NULL, $bank_id=NULL) {

        return BankLedger::where('bank_id',$bank_id)->where('transaction_date','>=', $from_date)->where('transaction_date','<=', $to_date)->orderBy('transaction_date', 'ASC')->get();
	}


    public function previous_blance($bank_id = NULL, $from_date = NULL) {
		$balance = 0; 
        $query = BankLedger::where('bank_id',$bank_id)->where('transaction_date','<', $from_date)->orderBy('transaction_date', 'ASC')->get();
		foreach ($query as $row) {
			if ($row->transaction_type == 'Payment' || $row->transaction_type == 'Expense') {
				$balance = $balance - $row->amount;
			} else {
				$balance = $balance + $row->amount;
			}
		}
		return $balance;
	}


    // destroy
    public function delete($id){

        return DB::transaction(function () use ($id) {
            $id         = hashid_decode($id);
            $data       = Bank::findOrFail($id);
            $success    = $data->delete();

            if ($success) {
                BankLedger::where('bank_id',$id)->delete();
            }
            
            if($success){
                Alert::success('Deleted!', deleted_success());
            }else{
                Alert::error('Error!', exception());
            }
            return redirect()->route('bank.index');

        });
        
    }

}
