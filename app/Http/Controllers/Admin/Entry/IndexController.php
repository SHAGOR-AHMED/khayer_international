<?php

namespace App\Http\Controllers\Admin\Entry;

use Session;
use Carbon\Carbon;
use App\Models\Entry;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\ImageUpload;

class IndexController extends Controller
{
    use ImageUpload;

    public function index(){
    	$data['allData'] = Entry::with(['agent','user'])->get();
    	return view('admin.entry.view',$data);
    }

    public function create(){
        $data['add'] = TRUE;
        return view('admin.entry.add', $data);
    }

    public function store(Request $request){

       $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'address'=>'required',
        ]);

        $data = new Entry();
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
        return redirect()->route('entry.index');

    }//store

    public function edit($id){
    	$data['edit'] = TRUE;
    	$data['single'] = Entry::findOrFail($id);
    	return view('admin.entry.add', $data);
    }

    public function update(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'address'=>'required',
        ]);
       
        $data = Entry::findOrFail($request->id);
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
        return redirect()->route('entry.edit',$request->id);
        
    }//update

    //control
    public function status($id){

        $data       =  Entry::find($id);
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
            return redirect()->route('entry.index');
        }
    }

    // destroy
    public function delete($id)
    {
        $data       =  Entry::find($id);
        $success    =  $data->delete();
        if($success){
            setMessage('message','success',deleted_success());
        }else{
            setMessage('message','danger',exception());
        }
        return redirect()->route('entry.index');
    }

}
