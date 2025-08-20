<?php

namespace App\Http\Controllers\Demo\Admin\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Demo\Supplier;
use Carbon\Carbon;

class IndexController extends Controller
{
    //index
    public function index(){
        $paginate       = Request('paginate', 10);
        $search         = Request('search', '');
        $sort_direction = Request('sort_direction', 'desc');
        $sort_field     = Request('sort_field', 'id');

        $allData = Supplier::orderBy($sort_field, $sort_direction)
                ->search( trim(preg_replace('/\s+/' ,' ', $search)) )
                ->paginate($paginate);
        return response()->json($allData, 200);

    }


    // store
    public function store(Request $request){

        //Validate
        $this->validate($request,[
            'supplier_name'   => 'required|string|max:100',
            'email'           => 'required|email|unique:suppliers',
            'mobile'          => 'required',
            'address'         => 'required',
        ]);

        $data = new Supplier();
        $data->supplier_name = $request->supplier_name;
        $data->email         = $request->email;
        $data->mobile        = $request->mobile;
        $data->address       = $request->address;
        $success             = $data->save();

        if($success){
            return response()->json(['msg'=>'Stored Successfully &#128513;', 'icon'=>'success'], 200);
        }else{
            return response()->json([
                'msg' => 'Data not save in DB !!'
            ], 422);
        }

    }


    // update
    public function update(Request $request){

        //Validate
        $this->validate($request,[
            'supplier_name'   => 'required|string|max:100',
            'email'           => 'required|email|unique:suppliers,email,'.$request->id,
            'mobile'          => 'required',
            'address'         => 'required',
        ]);
        
        $data                = Supplier::find($request->id);
        $data->supplier_name = $request->supplier_name;
        $data->email         = $request->email;
        $data->mobile        = $request->mobile;
        $data->address       = $request->address;
        $success             = $data->save();

        if($success){
            return response()->json(['msg'=>'Updated Successfully &#128515;', 'icon'=>'success'], 200);
        }else{
            return response()->json(['msg' => 'Data not save in DB !!'], 422);
        }

    }

    // destroy
    public function destroy($id)
    {
        $data       =  Supplier::find($id);
        $success    =  $data->delete();
        return response()->json('success', 200);

    }

    //Bulk delete
    public function deleteAll(Request $request){
        $count = 0;
        foreach($request->data as $id){
            $category       =  Supplier::find($id);
            $category->delete();
            $count++;
        }
        $success = $count > 0 ? true : false;
        return response()->json(['success' => $success, 'total' => $count], 200);

    }

    //Bulk status active
    public function statusActiveAll(Request $request){
        $count = 0;
        foreach($request->data as $id){
            $category         =  Supplier::find($id);
            $category->status = 1;
            $category->save();
            $count++;
        }
        $success = $count > 0 ? true : false;
        return response()->json(['success' => $success, 'total' => $count], 200);
    }

    //Bulk status deactive
    public function statusDeactiveAll(Request $request){
        $count = 0;
        foreach($request->data as $id){
            $category         =  Supplier::find($id);
            $category->status = 0;
            $category->save();
            $count++;
        }
        $success = $count > 0 ? true : false;
        return response()->json(['success' => $success, 'total' => $count], 200);

    }

    // status
    public function status($id){

        $data       =  Supplier::find($id);
        if($data){
           $status = $data->status;
            if($status == 1){
                $data->status = 0;
            }else{
                $data->status = 1;
            }
            $success    =  $data->save();
            return response()->json('success', 200);

        }
    }

    //get all supplier
    public function all_supplier(){
        $allSupplier = Supplier::where('status',1)->get();
        return response()->json($allSupplier, 200);
    }
}
