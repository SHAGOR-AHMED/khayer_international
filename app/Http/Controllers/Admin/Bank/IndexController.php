<?php

namespace App\Http\Controllers\Admin\Bank;

use App\Models\Bank;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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

        $data                     = new Bank();
        $data->bank_name          = $request->bank_name;
        $data->account_name       = $request->account_name;
        $data->account_no         = $request->account_no;
        $data->account_balance    = $request->account_balance;
        $data->bank_remarks       = $request->bank_remarks;
        $data->created_by         = logged_in_user_id();
        $success                  = $data->save();

        if($success){
            notify()->success(saved_success(),"Success","topRight");
        }else{
            notify()->error(exception(),"Error","topRight");
        }
        return redirect()->route('bank.index');

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
       
        $data           = Bank::findOrFail($request->id);
        
        $imagePath      = 'admin/userImage/';
        $imgFor = 'bank-';
        // Save/update Image 
        $current_image  = $request->image; 
        if($current_image){
            $old_image      = $data->image;
            $imgName= $this->imageUplaodByName($current_image, $old_image, $imagePath, $imgFor); 
            $data->image = $imgName;
        }

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
           $status = $data->status;
            if($status == 1){
                $data->status = 0;
            }else{
                $data->status = 1;
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

    // destroy
    public function delete($id)
    {
        $id         = hashid_decode($id);
        $data       = Bank::findOrFail($id);
        imageDeleteManager($data->image);
        $success    =  $data->delete();
        if($success){
            Alert::success('Deleted!', deleted_success());
        }else{
            Alert::error('Error!', exception());
        }
        return redirect()->route('bank.index');
    }

}
