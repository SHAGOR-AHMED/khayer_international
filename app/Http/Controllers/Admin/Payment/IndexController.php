<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class IndexController extends Controller
{
    public function index(){
    	$data['allData'] = Payment::get();
    	return view('admin.payment.view',$data);
    }

    public function create(){
        $data['add'] = TRUE;
        return view('admin.payment.add', $data);
    }

    public function store(Request $request){

       $this->validate($request,[
            'bank_name'=>'required',
            'account_name'=>'required',
            'account_no'=>'required',
            'account_balance'=>'required',
        ]);

        return DB::transaction(function () use ($request) {

            $data                     = new Payment();
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

    //control
    public function status($id){
        $id         = hashid_decode($id);
        $data       = Payment::findOrFail($id);
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
            return redirect()->route('payment.index');
        }
    }

    // destroy
    public function delete($id){

        dd('not done');
        
    }
    
}
