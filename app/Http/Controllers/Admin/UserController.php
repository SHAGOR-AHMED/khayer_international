<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

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
            'phone'=>'required',
            'email'=>'required',
            'gender'=>'required',
            'address'=>'required',
            'password'=>'required',
            'confirm_password'=>'required',
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
                setMessage('message',"success",saved_success());
            }else{
                setMessage('message',"danger",exception());
            }
            return redirect()->route('user.index');

       }else{
            setMessage('message',"danger",'Password and Confirm Password does not match !!!');
            return redirect()->route('user.add');
       }

    }//store

    public function edit($user_id){
    	$data['edit'] = TRUE;
    	$data['userByID'] = User::findOrFail($user_id);
    	return view('admin.user.add', $data);
    }

    public function update(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'gender'=>'required',
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
                        'image'=>$imageUrl,
                    ]);
    
        }else{

            $result = User::where('id',$request->id)
                    ->update([
                        'name'=>$request->name,
                        'phone'=>$request->phone,
                        'email'=>$request->email,
                        'gender'=>$request->gender,
                    ]);

        }

        if($result){
            setMessage('message',"success",updated_success());
        }else{
            setMessage('message',"danger",exception());
        }
        return redirect()->route('user.edit',$request->id);
        
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
	    	    setMessage('message',"success",updated_success());
            }else{
                setMessage('message',"danger",exception());
            }
            return redirect()->route('user.index');
        }
    }

     // destroy
    public function delete($user_id)
    {
        $data       =  User::find($user_id);
        $preImg = $data->image;
        if(!empty($preImg)){
            //Delete Old File
            if (file_exists($preImg)){
                unlink($preImg);
            }
        }
        $success    =  $data->delete();
        if($success){
            setMessage('message','success',deleted_success());
        }else{
            setMessage('message','danger',exception());
        }
        return redirect()->route('user.index');
    }

    public function updatePassword(Request $request){

        $this->validate($request,[
            'old_password'=>'required',
            'password'=>'required',
            'confirm_password'=>'required',
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
                    setMessage('message',"success",'Password has been updated !!! Login Again with New Password');
                    return redirect()->route('login');
                }else{
                    setMessage('message',"danger",'Failed to update !!!');
                    return redirect()->route('user.edit',$request->id);
                }

            }else{

                setMessage('message',"danger",'Password and Confirm Password does not match !!!');
                return redirect()->route('user.edit',$request->id);

            }

        }else{

            setMessage('message',"danger",'Old Password does not match !!!');
            return redirect()->route('user.edit',$request->id);
        }

    }//updatePassword

}//UserController