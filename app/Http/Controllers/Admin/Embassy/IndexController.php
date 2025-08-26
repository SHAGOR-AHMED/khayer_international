<?php

namespace App\Http\Controllers\Admin\Embassy;

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
    	$data['allData'] = Entry::with(['agent','user'])->latest()->where('status','EMBASSY')->get();
    	return view('admin.embassy.view',$data);
    }

    public function details($id){
    	$data['single'] = Entry::with(['agent','user'])->findOrFail($id);
    	return view('admin.entry.details',$data);
    }

    public function log(){
        $id = \request()->input("entry_id");
        $data['single'] = DB::table("entries")
            ->join('users as U', 'U.id', '=', 'entries.created_by', 'LEFT')
            ->join('users as UM', 'UM.id', '=', 'entries.updated_by', 'LEFT')
            ->select("entries.*", "U.name as created_by", "UM.name as updated_by")
            ->where("entries.id","=",$id)
            ->first();
        $returnHTML = view('admin.entry.log')->with($data)->render();
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

}
