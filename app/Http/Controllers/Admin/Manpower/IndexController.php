<?php

namespace App\Http\Controllers\Admin\Manpower;

use Session;
use Carbon\Carbon;
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
    	$data['allData'] = Entry::with(['agent','user'])->latest()->where('status','MANPOWER')->get();
    	return view('admin.manpower.view',$data);
    }

    public function details($hashid){
        $id = hashid_decode($hashid);
    	$data['single'] = Entry::with(['agent','user'])->findOrFail($id);
    	return view('admin.manpower.details',$data);
    }

    public function log(){
        $id = \request()->input("entry_id");
        $data['single'] = DB::table("entries")
            ->join('users as U', 'U.id', '=', 'entries.created_by', 'LEFT')
            ->join('users as UM', 'UM.id', '=', 'entries.updated_by', 'LEFT')
            ->select("entries.*", "U.name as created_by", "UM.name as updated_by")
            ->where("entries.id","=",$id)
            ->first();
        $returnHTML = view('admin.common.log')->with($data)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    public function update(Request $request){

        $this->validate($request,[
            'manpower_date'=>'required',
        ]);
       
        $data                     = Entry::findOrFail($request->id);
        $data->manpower_date      = $request->manpower_date;
        $data->updated_by         = logged_in_user_id();
        $success                  = $data->save();

        if($success){
            notify()->success(updated_success(),"Success","topRight");
        }else{
            notify()->error(exception(),"Error","topRight");
        }
        return redirect()->route('manpower.index');
        
    }//update

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
        return redirect()->route('delivery.index');
    }

}
