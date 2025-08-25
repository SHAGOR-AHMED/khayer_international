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
            'phone'=>'required',
            'passport_no'=>'required',
            'passport_expired_date'=>'required',
            'is_original_passport_given'=>'required',
            'address'=>'required',
            'password'=>'required',
            'confirm_password'=>'required',
        ]);

       $password = $request->password;
       $confirm_password = $request->confirm_password;

       if($password == $confirm_password){

            $passportDocUrl='';
            if(!empty($request->file('passport_doc'))){
                $doc = $request->file('passport_doc');
                $name = $doc->getClientOriginalName();
                $ext = explode('.',$name);
                $finalName = 'passport-'.time().'.'.$ext[1];
                $uploadPath = 'admin/documents/';
                $doc->move($uploadPath, $finalName);
                $passportDocUrl = $uploadPath.$finalName;
            }

            $data                          = new User();

            $imagePath      = 'admin/userImage/';
            $imgFor = 'client-';
            // Save Image 
            $current_image  = $request->file('image'); 
            if(!empty($current_image)){
                $imgName= $this->imageUplaodByName($current_image, null, $imagePath, $imgFor); 
                $data->image = $imgName;
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
            $data->password                     = Hash::make($request->password);
            $data->passport_doc                 = ($passportDocUrl) ? $passportDocUrl : NULL;
            $data->created_by                   = logged_in_user_id();
            $success                            = $data->save();

            if($success){
                notify()->success(saved_success(),"Success","topRight");
            }else{
                notify()->error(exception(),"Error","topRight");
            }
            return redirect()->route('client.index');

       }else{
            notify()->error("Password and Confirm Password does not match !!!","Error","topRight");
            return redirect()->route('client.add');
       }

    }//store

    public function edit($user_id){
    	$data['edit'] = TRUE;
    	$data['single'] = User::findOrFail($user_id);
    	return view('admin.client.edit', $data);
    }

    public function update(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            'passport_no'=>'required',
            'passport_expired_date'=>'required',
            'address'=>'required',
        ]);
       
        $data = User::findOrFail($request->id);
        $userImage = $request->file('image');
        $passDoc = $request->file('passport_doc');

        if($passDoc){
            $preDoc = $data->passport_doc;
            if (file_exists($preDoc)){
                unlink($preDoc);
            }
            $name = $passDoc->getClientOriginalName();
            $ext = explode('.',$name);
            $finalName = 'passport-'.time().'.'.$ext[1];
            $uploadPath = 'admin/documents/';
            $passDoc->move($uploadPath, $finalName);
            $passportDocUrl = $uploadPath.$finalName;
            $data->passport_doc = $passportDocUrl;
        }

        if($userImage){
            $preImg = $data->image;
            if (file_exists($preImg)){
                unlink($preImg);
            }
            $name = $userImage->getClientOriginalName();
            $ext = explode('.',$name);
            $finalName = 'user-'.time().'.'.$ext[1];
            $uploadPath = 'admin/userImage/';
            $userImage->move($uploadPath, $finalName);
            $imageUrl = $uploadPath.$finalName;
            $data->image = $imageUrl;
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
            notify()->success(updated_success(),"Success","topRight");
        }else{
            notify()->error(exception(),"Error","topRight");
        }

        return redirect()->route('client.edit',$request->id);
        
    }//update

    //control
    public function status($user_id){

        $data       =  User::find($user_id);
        if($data){
            $status = $data->status;
            if($status == 1){
                $data->status = 0;
            }else{
                $data->status = 1;
            }
            $success    =  $data->save();
            if($success){
                notify()->success(updated_success(),"Success","topRight");
            }else{
                notify()->error(exception(),"Error","topRight");
            }
        }
        return redirect()->route('client.index');
    }

    // destroy
    public function delete($user_id)
    {
        $data       =  User::find($user_id);
        $preImg = $data->image;
        $preDoc = $data->passport_doc;
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
            notify()->error(deleted_success(),"Success","topRight");
        }else{
            notify()->error(exception(),"Error","topRight");
        }
        return redirect()->route('client.index');
    }

}