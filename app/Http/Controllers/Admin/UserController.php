<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index(){
    	$data['users'] = User::where('type','!=','user')->get();
    	return view('admin.user.view',$data);
    }

    public function create(){
        $data['add'] = TRUE;
        return view('admin.user.add', $data);
    }

    public function store(Request $request){

       $this->validate($request,[
            'name'=>'required',
            'phone'=>'required|digits_between:11,14',
            'email'=>'required|email:filter',
            'gender'=>'required',
            'address'=>'required|max:255',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
        ]);

       $password = $request->password;
       $confirm_password = $request->confirm_password;

       if($password == $confirm_password){

            $imageUrl='';
            if(!empty($request->file('image'))){
                $userImg = $request->file('image');
                $name = $userImg->getClientOriginalName();
                $uploadPath = 'admin/userImage/';
                $userImg->move($uploadPath, $name);
                $imageUrl = $uploadPath.$name;
            }

            $data = new User();
            $data->name          = $request->name;
            $data->email         = $request->email;
            $data->phone         = $request->phone;
            $data->gender        = $request->gender;
            $data->address       = $request->address;
            $data->type          = $request->type;
            $data->password      = Hash::make($request->password);
            $data->image         = ($imageUrl) ? $imageUrl : NULL;
            $success             = $data->save();

            if($success){
                notify()->success(saved_success(),"Success","topRight");
            }else{
                notify()->error(exception(),"Error","topRight");
            }
            return redirect()->route('user.index');

       }else{
            notify()->error("Password and Confirm Password does not match !!!","Error","topRight");
            return redirect()->route('user.add');
       }

    }//store

    public function edit($hash_id){
    	$data['edit'] = TRUE;
        $id = hashid_decode($hash_id);
    	$data['userByID'] = User::findOrFail($id);
    	return view('admin.user.add', $data);
    }

    public function update(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required|digits_between:11,14',
            'email'=>'required|email:filter',
            'gender'=>'required',
            'address'=>'required|max:255',
        ]);
       
        $userByID = User::findOrFail($request->id);
        $userImage = $request->file('image');

        if($userImage){

            $preImg = $userByID->image;
            if($preImg){
                unlink($preImg);
            }
            $name = $userImage->getClientOriginalName();
            $uploadPath = 'admin/userImage/';
            $userImage->move($uploadPath, $name);
            $imageUrl = $uploadPath.$name;

            $result = User::where('id',$request->id)
                    ->update([
                        'name'=>$request->name,
                        'phone'=>$request->phone,
                        'email'=>$request->email,
                        'gender'=>$request->gender,
                        'address'=>$request->address,
                        'image'=>$imageUrl,
                    ]);
    
        }else{

            $result = User::where('id',$request->id)
                    ->update([
                        'name'=>$request->name,
                        'phone'=>$request->phone,
                        'email'=>$request->email,
                        'gender'=>$request->gender,
                        'address'=>$request->address,
                    ]);

        }

        if($result){
            notify()->success(updated_success(),"Success","topRight");
        }else{
            notify()->error(exception(),"Error","topRight");
        }
        return redirect()->route('user.index');
        
    }//update

    //control
    public function status($hash_id){
        $id         = hashid_decode($hash_id);
        $data       =  User::find($id);
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
            return redirect()->route('user.index');
        }
    }

    // destroy
    public function delete($hash_id){
        $id         = hashid_decode($hash_id);
        $data       =  User::find($id);
        $preImg = $data->image;
        if(!empty($preImg)){
            //Delete Old File
            if (file_exists($preImg)){
                unlink($preImg);
            }
        }
        $success    =  $data->delete();
        if($success){
            notify()->success(deleted_success(),"Success","topRight");
        }else{
            notify()->error(exception(),"Error","topRight");
        }
        return redirect()->route('user.index');
    }

    public function updatePassword(Request $request){

        $this->validate($request,[
            'old_password'=>'required',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
        ]);

        $userByID = User::find($request->id);
        $userPassword = $userByID->password;

        if (Hash::check($request->input('old_password'), $userPassword)) {
            
            $password = $request->password;
            $confirm_password = $request->confirm_password;

            if($password == $confirm_password){
                $result = User::where('id',$request->id)
                    ->update([
                        'password'=>Hash::make($request->password),
                    ]);

                if($result){
                    Auth::logout();
                    // Session::forget('loggedData');
                    Alert::success('Success!', "Password has been updated !!! Login Again with New Password");
                    return redirect()->route('login');
                }else{
                    notify()->error(exception(),"Error","topRight");
                    return redirect()->route('user.edit',hashid_encode($request->id));
                }

            }else{
                notify()->error("Password and Confirm Password does not match !!!","Error","topRight");
                return redirect()->route('user.edit',hashid_encode($request->id));

            }

        }else{
            notify()->error("Old Password does not match !!!","Error","topRight");
            return redirect()->route('user.edit',hashid_encode($request->id));
        }

    }//updatePassword

}//UserController