<?php

namespace App\Http\Controllers\Admin\Entry;

use Session;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Agent;
use App\Models\Entry;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\ImageUpload;

class IndexController extends Controller
{
    use ImageUpload;

    public function index(){
    	$data['allData'] = Entry::with(['agent','user'])->latest()->get();
    	return view('admin.entry.view',$data);
    }

    public function details($hashid){
        $id = hashid_decode($hashid);
    	$data['single'] = Entry::with(['agent','user'])->findOrFail($id);
    	return view('admin.entry.details',$data);
    }

    public function log(){
        $id = \request()->input("entry_id");
        //$data['single'] = Entry::with(['created_by','updated_by'])->findOrFail($id);

        $data['single'] = DB::table("entries")
            ->join('users as U', 'U.id', '=', 'entries.created_by', 'LEFT')
            ->join('users as UM', 'UM.id', '=', 'entries.updated_by', 'LEFT')
            ->select("entries.*", "U.name as created_by", "UM.name as updated_by")
            ->where("entries.id","=",$id)
            ->first();
        $returnHTML = view('admin.common.log')->with($data)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    public function create(){
        $data['add'] = TRUE;
        $data['all_agents'] = Agent::query()
                            ->where('status',1)
                            ->pluck('name', 'id')
                            ->prepend('Please Select', '')
                            ->toArray();
        $data['all_clients'] = User::where('type','user')->get();
        $data['all_countries'] = DB::table('countries')->get();
        return view('admin.entry.add', $data);
    }

    public function store(Request $request){

       $this->validate($request,[
            'agent_id'=>'required',
            'rl_no'=>'required',
            'country'=>'required',
            'client_id'=>'required',
            'profession'=>'required',
            'office_visa'=>'required',
            'processing'=>'required',
            'gcc_medical_report'=>'required',
        ]);

        $data                      = new Entry();
        $data->agent_id            = $request->agent_id;
        $data->rl_no               = $request->rl_no;
        $data->country             = $request->country;
        $data->client_id           = $request->client_id;
        $data->profession          = $request->profession;
        $data->office_visa         = $request->office_visa;
        $data->processing          = $request->processing;
        $data->sponsor_no          = $request->sponsor_no;
        $data->pc_ref_no           = $request->pc_ref_no;
        $data->medical_report      = $request->medical_report;
        $data->gcc_medical_report  = $request->gcc_medical_report;
        $data->note                = $request->note;
        $data->created_by          = logged_in_user_id();
        $success                   = $data->save();

        if($success){
            notify()->success(saved_success(),"Success","topRight");
        }else{
            notify()->error(exception(),"Error","topRight");
        }
        return redirect()->route('entry.index');

    }//store

    public function nextStage(Request $request){
        $data               = Entry::findOrFail($request->id);
        $data->status       = $request->status;
        $data->updated_by   = logged_in_user_id();
        $success            = $data->save();
        if($success){
            notify()->success(updated_success(),"Success","topRight");
        }else{
            notify()->error(exception(),"Error","topRight");
        }
        return redirect()->route('entry.index');
    }

    public function return_application(Request $request){

        $this->validate($request,[
            'return_cause'=>'required',
        ]);
       
        $data = Entry::findOrFail($request->id);
        $data->is_returned     = 'YES';
        $data->return_cause    = $request->return_cause;
        $data->updated_by      = logged_in_user_id();
        $success               = $data->save();

        if($success){
            notify()->success(updated_success(),"Success","topRight");
        }else{
            notify()->error(exception(),"Error","topRight");
        }
        return redirect()->route('entry.index');
        
    }

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
        $data->updated_by   = logged_in_user_id();
        $success            = $data->save();

        if($success){
            notify()->success(updated_success(),"Success","topRight");
        }else{
            notify()->error(exception(),"Error","topRight");
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
                notify()->success(updated_success(),"Success","topRight");
            }else{
                notify()->error(exception(),"Error","topRight");
            }
            return redirect()->route('entry.index');
        }
    }

    // destroy
    public function delete($id){
        $data       =  Entry::find($id);
        $success    =  $data->delete();
        if($success){
            notify()->success(deleted_success(),"Success","topRight");
        }else{
            notify()->error(exception(),"Error","topRight");
        }
        return redirect()->route('entry.index');
    }

}
