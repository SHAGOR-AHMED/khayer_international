<?php

namespace App\Http\Controllers\Admin\Supplier;

use PDF;
use Session;
use Carbon\Carbon;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SupplierLedger;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Common\ImageUpload;

class IndexController extends Controller
{
    use ImageUpload;

    public function index(){
    	$data['allData'] = Supplier::get();
    	return view('admin.supplier.view',$data);
    }

    public function create(){
        $data['add'] = TRUE;
        return view('admin.supplier.add', $data);
    }

    public function store(Request $request){

        $this->validate($request,[
            'office_name'=>'required',
            'address'=>'required',
            'type'=>'required',
        ]);

        $balance = '0.00';
        if($request->balance){
            $balance = $request->balance;
        }

        $data                = new Supplier();
        $data->office_name   = $request->office_name;
        $data->phone         = $request->phone;
        $data->balance       = $balance;
        $data->address       = $request->address;
        $data->type          = $request->type;
        $success             = $data->save();

        if ($success) {
            // Create supplier ledger
            $ledgerData = array(
                'id' => make_id('supplier_ledger', 'id', 'SL'),
                'supplier_id' => $data->id,
                'billing_date' => date('d-m-Y'),
                'transaction_type' => "Initial Balance",
                'amount' => $balance,
                'ledger_status' => "Active",
            );
            SupplierLedger::insert($ledgerData);

            notify()->success(saved_success(),"Success","topRight");

        }else{
            notify()->error(exception(),"Error","topRight");
        }
        return redirect()->route('supplier.index');

    }//store

    public function edit($id){
    	$data['edit'] = TRUE;
        $id = hashid_decode($id);
    	$data['single'] = Supplier::findOrFail($id);
    	return view('admin.supplier.add', $data);
    }

    public function update(Request $request){

        $this->validate($request,[
            'office_name'=>'required',
            'address'=>'required',
            'type'=>'required',
        ]);
       
        $data                = Supplier::findOrFail($request->id);
        $data->office_name   = $request->office_name;
        $data->phone         = $request->phone;
        $data->address       = $request->address;
        $data->type          = $request->type;
        $success             = $data->save();

        if($success){
            notify()->success(updated_success(),"Success","topRight");
        }else{
            notify()->error(exception(),"Error","topRight");
        }
        return redirect()->route('supplier.index');
        
    }//update

    //control
    public function status($id){
        $id = hashid_decode($id);
        $data       =  Supplier::findOrFail($id);
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
            return redirect()->route('supplier.index');
        }
    }

    public function ledger(){
        $data['all_suppliers'] = Supplier::query()
                            ->where('status',1)
                            ->pluck('office_name', 'id')
                            ->prepend('Please Select', '')
                            ->toArray();
    	return view('admin.supplier.ledger',$data);
    }

    public function report(Request $request){

        $from_date = $request->date_range_from;
		$to_date = $request->date_range_to;
		$supplier_id = $request->supplier_id;

        $data['title'] = "Ledger Account";
		$data['supplier'] = Supplier::find($supplier_id);
		$data['results'] = $this->ledger_report($from_date, $to_date, $supplier_id);
		$data['from_date'] = $from_date;
		$data['to_date'] = $to_date;

        $pdf = PDF::loadHtml(view('admin.supplier.ledger_report', $data));
        return $pdf->stream('supplier-ledger'.date('m-d-Y').'.pdf');
    }

    public function ledger_report($from_date = NULL, $to_date=NULL, $supplier_id=NULL) {

        return SupplierLedger::where('supplier_id',$supplier_id)->where('billing_date','>=', $from_date)->where('billing_date','<=', $to_date)->get();
	}


    public function previous_blance($supplier_id = NULL, $from_date = NULL) {
		$balance = 0; 
        $query = SupplierLedger::where('supplier_id',$supplier_id)->where('billing_date','<', $from_date)->orderBy('id', 'ASC')->get();
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
    public function delete($id){
        return DB::transaction(function () use ($id) {
            $id         = hashid_decode($id);
            $data       = Supplier::findOrFail($id);
            $success    = $data->delete();

            if ($success) {
                SupplierLedger::where('supplier_id',$id)->delete();
                Alert::success('Deleted!', deleted_success());
            }else{
                Alert::error('Error!', exception());
            }
            return redirect()->route('supplier.index');
        });
        
    }

}
