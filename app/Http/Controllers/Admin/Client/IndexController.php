<?php

namespace App\Http\Controllers\Admin\Client;

use Session;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\ImageUpload;

class IndexController extends Controller
{

    use ImageUpload;

    public function index(){
    	$data['users'] = User::where('type', 'user')->get();
    	return view('admin.client.view',$data);
    }

    public function edit($user_id){
    	$data['edit'] = TRUE;
    	$data['single'] = User::findOrFail($user_id);
    	return view('admin.client.edit', $data);
    }

    public function update(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'passport_no'=>'required',
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

        $data->name         = $request->name;
        $data->email        = $request->email;
        $data->phone        = $request->phone;
        $data->passport_no  = $request->passport_no;
        $data->gender       = $request->gender;
        $data->address      = $request->address;
        $success            = $data->save();

        if($success){
            setMessage('message',"success",updated_success());
            return redirect()->route('client.edit',$request->id);
        }else{
            setMessage('message',"danger",exception());
            return redirect()->route('client.edit',$request->id);
        }
        
    }//update


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
            setMessage('message','success',deleted_success());
            return redirect()->route('client.index');
        }else{
            setMessage('message','danger',exception());
            return redirect()->route('client.index');
        }
    }

}