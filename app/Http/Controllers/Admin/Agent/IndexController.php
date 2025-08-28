<?php

namespace App\Http\Controllers\Admin\Agent;

use Session;
use Carbon\Carbon;
use App\Models\Agent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
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
            'phone'=>'required|digits_between:11,14',
            'address'=>'required',
        ]);

        $data = new Agent();

        $imagePath      = 'admin/userImage/';
        $imgFor = 'agent-';
        // Save Image 
        $current_image  = $request->file('image'); 
        if($current_image){
            $imgName= $this->imageUplaodByName($current_image, null, $imagePath, $imgFor); 
            $data->image = $imgName;
        }

        $data->name          = $request->name;
        $data->email         = $request->email;
        $data->phone         = $request->phone;
        $data->address       = $request->address;
        $success             = $data->save();

        if($success){
            notify()->success(saved_success(),"Success","topRight");
        }else{
            notify()->error(exception(),"Error","topRight");
        }
        return redirect()->route('agent.index');

    }//store

    public function edit($id){
    	$data['edit'] = TRUE;
        $id = hashid_decode($id);
    	$data['single'] = Agent::findOrFail($id);
    	return view('admin.agent.add', $data);
    }

    public function update(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required|digits_between:11,14',
            'address'=>'required',
        ]);
       
        $data = Agent::findOrFail($request->id);
        
        $imagePath      = 'admin/userImage/';
        $imgFor = 'agent-';
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
        return redirect()->route('agent.index');
        
    }//update

    //control
    public function status($id){
        $id = hashid_decode($id);
        $data       =  Agent::findOrFail($id);
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
            return redirect()->route('agent.index');
        }
    }

    // destroy
    public function delete($id)
    {
        $id = hashid_decode($id);
        $data       =  Agent::findOrFail($id);
        imageDeleteManager($data->image);
        $success    =  $data->delete();
        if($success){
            Alert::success('Deleted!', deleted_success());
        }else{
            Alert::error('Error!', exception());
        }
        return redirect()->route('agent.index');
    }

}
