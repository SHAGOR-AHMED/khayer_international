<?php

namespace App\Http\Controllers\Admin\Client;

use Session;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Common\ImageUpload;

class IndexController extends Controller
{
    use ImageUpload;

    public function index(){
    	$data['users'] = User::where('type', 'user')->get();
    	return view('admin.client.view',$data);
    }

    public function create(){
        $data['add'] = TRUE;
        return view('admin.client.add', $data);
    }

    public function store(Request $request){

       $this->validate($request,[
            'name'=>'required',
            'phone'=>'required|digits_between:11,14',
            'passport_no'=>'required',
            'passport_expired_date'=>'required',
            'is_original_passport_given'=>'required',
            'address'=>'required|max:255',
        ]);

        $data           = new User();

        // Save Image 
        $imagePath      = 'admin/userImage/';
        $imgFor = 'passenger-';
        $current_image  = $request->file('image'); 
        if($current_image){
            $imgName= $this->imageUplaodByName($current_image, null, $imagePath, $imgFor); 
            $data->image = $imgName;
        }

        // Save Doc
        $path = 'admin/documents/';
        $current_doc  = $request->file('passport_doc'); 
        if($current_doc){
            $docName= $this->documentUpload($current_doc, null, $path); 
            $data->passport_doc = $docName;
        }

        $data->name                         = $request->name;
        $data->email                        = $request->email;
        $data->phone                        = $request->phone;
        $data->dob                          = $request->dob;
        $data->passport_no                  = $request->passport_no;
        $data->passport_expired_date        = $request->passport_expired_date;
        $data->is_original_passport_given   = $request->is_original_passport_given;
        $data->gender                       = $request->gender;
        $data->address                      = $request->address;
        $data->password                     = Hash::make('12345678');
        $data->created_by                   = logged_in_user_id();
        $success                            = $data->save();

        if($success){
            notify()->success(saved_success(),"Success","topRight");
        }else{
            notify()->error(exception(),"Error","topRight");
        }
        return redirect()->route('client.index');

    }//store

    public function edit($hash_id){
    	$data['edit'] = TRUE;
        $id = hashid_decode($hash_id);
    	$data['single'] = User::findOrFail($id);
    	return view('admin.client.edit', $data);
    }

    public function update(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required|digits_between:11,14',
            'gender'=>'required',
            'passport_no'=>'required',
            'passport_expired_date'=>'required',
            'address'=>'required',
        ]);
       
        $data = User::findOrFail($request->id);

        // Save/Update Image 
        $imagePath      = 'admin/userImage/';
        $imgFor         = 'passenger-';
        $current_image  = $request->image; 
        if($current_image){
            $old_image      = $data->image;
            $imgName= $this->imageUplaodByName($current_image, $old_image, $imagePath, $imgFor); 
            $data->image = $imgName;
        }

        // Save/Update Doc
        $path = 'admin/documents/';
        $current_doc  = $request->file('passport_doc'); 
        if($current_doc){
            $oldDoc  = $data->passport_doc;
            $docName = $this->documentUpload($current_doc, $oldDoc, $path); 
            $data->passport_doc = $docName;
        }

        $data->name                         = $request->name;
        $data->email                        = $request->email;
        $data->phone                        = $request->phone;
        $data->dob                          = $request->dob;
        $data->passport_no                  = $request->passport_no;
        $data->passport_expired_date        = $request->passport_expired_date;
        $data->is_original_passport_given   = $request->is_original_passport_given;
        $data->gender                       = $request->gender;
        $data->address                      = $request->address;
        $data->updated_by                   = logged_in_user_id();
        $success                            = $data->save();

        if($success){
            notify()->info(updated_success(),"Success","topRight");
        }else{
            notify()->error(exception(),"Error","topRight");
        }

        return redirect()->route('client.index');
        
    }//update

    //control
    public function status($hash_id){
        $id         = hashid_decode($hash_id);
        $data       = User::find($id);
        if($data){
            $status = $data->status;
            if($status == 1){
                $data->status = 0;
            }else{
                $data->status = 1;
            }
            $success    =  $data->save();
            if($success){
                notify()->info(updated_success(),"Success","topRight");
            }else{
                notify()->error(exception(),"Error","topRight");
            }
        }
        return redirect()->route('client.index');
    }

    // destroy
    public function delete($hash_id){
        $id         = hashid_decode($hash_id);
        $data       = User::find($id);
        $preImg     = $data->image;
        $preDoc     = $data->passport_doc;
        if(!empty($preImg)){
            if (file_exists($preImg)){
                unlink($preImg);
            }
        }
        if(!empty($preDoc)){
            if (file_exists($preDoc)){
                unlink($preDoc);
            }
        }
        $success    =  $data->delete();
        if($success){
            notify()->success(deleted_success(),"Success","topRight");
        }else{
            notify()->error(exception(),"Error","topRight");
        }
        return redirect()->route('client.index');
    }

}