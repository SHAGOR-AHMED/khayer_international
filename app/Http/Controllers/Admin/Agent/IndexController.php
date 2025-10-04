<?php

namespace App\Http\Controllers\Admin\Agent;

use PDF;
use Session;
use Carbon\Carbon;
use App\Models\Agent;
use App\Models\AgentLedger;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'address'=>'required',
        ]);

        $balance = '0.00';
        if($request->balance){
            $balance = $request->balance;
        }

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
        $data->balance       = $balance;
        $data->address       = $request->address;
        $success             = $data->save();

        if($success){
            // Create agent ledger
            $ledgerData = array(
                'id' => make_id('agent_ledger', 'id', 'AL'),
                'agent_id' => $data->id,
                'billing_date' => date('Y-m-d'),
                'transaction_type' => "Initial Balance",
                'amount' => $balance,
                'ledger_status' => "Active",
            );
            AgentLedger::insert($ledgerData);

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
        $id         = hashid_decode($id);
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

    public function ledger(){
        $data['all_agents'] = Agent::query()
                            ->where('status',1)
                            ->pluck('name', 'id')
                            ->prepend('Please Select', '')
                            ->toArray();
    	return view('admin.agent.ledger',$data);
    }

    public function report(Request $request){

        $from_date = date("Y-m-d",strtotime($request->date_range_from));
        $to_date = date("Y-m-d",strtotime($request->date_range_to));
		$agent_id = $request->agent_id;

        $data['title'] = "Ledger Account";
		$data['agent'] = Agent::find($agent_id);
		$data['results'] = $this->ledger_report($from_date, $to_date, $agent_id);
		$data['from_date'] = $from_date;
		$data['to_date'] = $to_date;

        $pdf = PDF::loadHtml(view('admin.agent.ledger_report', $data));
        return $pdf->stream('ledger-report'.date('m-d-Y').'.pdf');
    }

    public function ledger_report($from_date = NULL, $to_date=NULL, $agent_id=NULL) {

        return AgentLedger::where('agent_id',$agent_id)->where('billing_date','>=', $from_date)->where('billing_date','<=', $to_date)->get();

        // return DB::table('agent_ledger')
        //     ->where('agent_id', $agent_id)
        //     ->whereBetween('billing_date', [$from_date, $to_date])
        //     ->select('agent_ledger.*')
        //     ->get();
	}

    public function previous_blance($agent_id = NULL, $from_date = NULL) {
		$balance = 0; 
        $query = AgentLedger::where('agent_id',$agent_id)->where('billing_date','<', $from_date)->orderBy('id', 'ASC')->get();
		foreach ($query as $row) {
			if ($row->transaction_type == 'Received') {
				$balance = $balance - $row->amount;
			} else {
				$balance = $balance + $row->amount;
			}
		}
		return $balance;
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
