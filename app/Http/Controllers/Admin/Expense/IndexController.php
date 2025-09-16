<?php

namespace App\Http\Controllers\Admin\Expense;

use PDF;
use App\Models\Bank;
use App\Models\Agent;
use App\Models\Expense;
use App\Models\BankLedger;
use App\Models\AgentLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Common\ImageUpload;

class IndexController extends Controller
{
    use ImageUpload;

    public function index(){
    	$data['allData'] = Expense::with(['bank'])->get();
    	return view('admin.expense.view',$data);
    }

    public function create(){
        $data['add'] = TRUE;
        $data['all_banks'] = Bank::query()
                            ->where('id','!=',1)
                            ->pluck('bank_name', 'id')
                            ->prepend('Please Select', '')
                            ->toArray();
        return view('admin.expense.add', $data);
    }

    public function store(Request $request){

       $this->validate($request,[
            'transaction_date'  =>'required',
            'payment_mode'      =>'required',
            'amount'            =>'required',
            'description'       =>'required',
        ]);

        return DB::transaction(function () use ($request) {

            $payment_mode = $request->payment_mode;
            $status = "Active";
            $bank_id = '';

            $data                     = new Expense();

            $imagePath      = 'admin/documents/';
            $imgFor = 'expense-';
            // Save Image 
            $current_image  = $request->file('image'); 
            if($current_image){
                $imgName= $this->imageUplaodByName($current_image, null, $imagePath, $imgFor); 
                $data->image = $imgName;
            }

            if ($payment_mode == 'Cash') {
				$bank_id = '1';
			} else {
				$bank_id = $request->bank_id;
			}
            
            $data->transaction_date   = date('d-m-Y', strtotime($request->transaction_date));
            $data->bank_id            = $bank_id;
            $data->amount             = $request->amount;
            $data->description        = $request->description;
            $data->status             = $status;
            $data->created_by         = logged_in_user_id();
            $data->log                = logged_in_user_name() . "<br/>" .  $request->transaction_date;
            $success                  = $data->save();

            if ($success) {

                if ($bank_id == '1') {
					// Check cash balance limitation
					$cash = Bank::where('id',1)->first();
					if ($request->amount > $cash->account_balance) {
						notify()->error(limit_crossed(),"Error","topRight");
						return redirect()->route('expense.index');
					}
				}
                
                // Update bank account balance
                Bank::where('id',$bank_id)
                    ->update([
                        'account_balance' => DB::raw('account_balance - ' . (int) $request->amount),
                    ]);
                // Create bank ledger
                $Bldata = array(
                    'id'               => make_id('bank_ledger', 'id', 'BL'),
                    'bank_id'          => $bank_id,
                    'transaction_date' => $request->transaction_date,
                    'transaction_type' => "Expense",
                    'reference_no'     => $data->id,
                    'amount'           => $request->amount,
                    'ledger_status'    => $status,
                );
                BankLedger::insert($Bldata);
				
                notify()->success(saved_success(),"Success","topRight");

            }else{
                notify()->error(exception(),"Error","topRight");
            }

            return redirect()->route('expense.index');

        });

    }//store

    public function edit($id){
    	$data['edit'] = TRUE;
        $id = hashid_decode($id);
    	$data['single'] = Expense::findOrFail($id);
    	return view('admin.expense.add', $data);
    }

    public function update(Request $request){

        dd('okk');
        
    }//update


    public function particulars($reference_no = NULL) {
		$particular = $expense_mode = $description =  '';
		
		$expense = Expense::with('bank')->find($reference_no);
		$expense_mode = $expense->bank->bank_name;
		
		if ($expense->description) {
            $particular = $expense->description . " @ Tk. " .
				bd_money_format($expense->amount) . "; ";
		}
		
		return "<span style='font-size:11px'>" . $particular . $expense_mode . "</span>";
	}

    public function report(){
        $data['title'] = 'Expense Report';
        $data['allData'] = Expense::with(['bank'])->get();
        $pdf = PDF::loadHtml(view('admin.expense.report', $data));
        return $pdf->stream('Expense-report'.date('m-d-Y').'.pdf');
    }

    // destroy
    public function delete($id){

        dd('not done');
        
    }
    
}
