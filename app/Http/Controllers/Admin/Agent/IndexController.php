<?php

namespace App\Http\Controllers\Admin\Agent;

use Session;
use Carbon\Carbon;
use App\Models\Agent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\ImageUpload;

class IndexController extends Controller
{
    use ImageUpload;

    public function index(){
    	$data['allData'] = Agent::get();
    	return view('admin.agent.view',$data);
    }

    public function create(){
        $data['add'] = TRUE;
        return view('admin.agent.add', $data);
    }

    public function store(Request $request){

       $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'address'=>'required',
        ]);

        $data = new Agent();

        $imagePath      = 'admin/userImage/';
        $imgFor = 'agent-';
        // Save Image 
        $current_image  = $request->file('image'); 
        if(!empty($current_image)){
            $imgName= $this->imageUplaodByName($current_image, null, $imagePath, $imgFor); 
            $data->image = $imgName;
        }

        $data->name          = $request->name;
        $data->email         = $request->email;
        $data->phone         = $request->phone;
        $data->address       = $request->address;
        $success             = $data->save();

        if($success){
            setMessage('message',"success",saved_success());
        }else{
            setMessage('message',"danger",exception());
        }
        return redirect()->route('agent.index');

    }//store

    public function edit($id){
    	$data['edit'] = TRUE;
    	$data['single'] = Agent::findOrFail($id);
    	return view('admin.agent.add', $data);
    }

    public function update(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'address'=>'required',
        ]);
       
        $data = Agent::findOrFail($request->id);

        $userImage = $request->file('image');
        if($userImage){
            $preImg = $data->image;
            if (file_exists($preImg)){
                unlink($preImg);
            }
            $name = $userImage->getClientOriginalName();
            $ext = explode('.',$name);
            $finalName = 'agent-'.time().'.'.$ext[1];
            $uploadPath = 'admin/userImage/';
            $userImage->move($uploadPath, $finalName);
            $imageUrl = $uploadPath.$finalName;
            $data->image = $imageUrl;
        }

        // $imagePath      = 'admin/userImage/';
        // $imgFor = 'agent-';
        // // Save/update Image 
        // $current_image  = $request->image; 
        // if($current_image){
        //     $old_image      = $data->image;
        //     $imgName= $this->imageUplaodByName($current_image, $old_image, $imagePath, $imgFor); 
        //     $data->image = $imgName;
        // }

        $data->name         = $request->name;
        $data->email        = $request->email;
        $data->phone        = $request->phone;
        $data->address      = $request->address;
        $success            = $data->save();

        if($success){
            setMessage('message',"success",updated_success());
        }else{
            setMessage('message',"danger",exception());
        }
        return redirect()->route('agent.edit',$request->id);
        
    }//update

    //control
    public function status($id){

        $data       =  Agent::find($id);
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
                notify()->error(exception(),"Error","topLeft");
            }
            return redirect()->route('agent.index');
        }
    }

    // destroy
    public function delete($id)
    {
        $data       =  Agent::find($id);
        imageDeleteManager($data->image);
        $success    =  $data->delete();
        if($success){
            setMessage('message','success',deleted_success());
        }else{
            setMessage('message','danger',exception());
        }
        return redirect()->route('agent.index');
    }

}
