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

    public function index()
    {
        $data['allData'] = Entry::with(['agent', 'user'])->latest()->where('status', 'EMBASSY')->get();
        return view('admin.embassy.view', $data);
    }

    public function details($hashid)
    {
        $id = hashid_decode($hashid);
        $data['single'] = Entry::with(['agent', 'user'])->findOrFail($id);
        return view('admin.embassy.details', $data);
    }

    public function log()
    {
        $id = \request()->input("entry_id");
        $data['single'] = DB::table("entries")
            ->join('users as U', 'U.id', '=', 'entries.created_by', 'LEFT')
            ->join('users as UM', 'UM.id', '=', 'entries.updated_by', 'LEFT')
            ->select("entries.*", "U.name as created_by", "UM.name as updated_by")
            ->where("entries.id", "=", $id)
            ->first();
        $returnHTML = view('admin.common.log')->with($data)->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'visa_no' => 'required',
            'mofa_no' => 'required',
        ]);

        $data                       = Entry::findOrFail($request->id);
        $data->visa_no              = $request->visa_no;
        $data->id_no                = $request->id_no;
        $data->wakala_date          = $request->wakala_date;
        $data->mofa_no              = $request->mofa_no;
        $data->tasheer_finger_date  = $request->tasheer_finger_date;
        $data->visa_issued_date     = $request->visa_issued_date;
        $data->finger_ttc_note      = $request->finger_ttc_note;
        $data->updated_by           = logged_in_user_id();
        $success                    = $data->save();

        if ($success) {
            notify()->success(updated_success(), "Success", "topRight");
        } else {
            notify()->error(exception(), "Error", "topRight");
        }
        return redirect()->route('embassy.index');
    } //update

    public function nextStage(Request $request)
    {
        $entry = Entry::findOrFail($request->id);
        $request->merge([
            'visa_no' => $entry->visa_no,
            'mofa_no' => $entry->mofa_no,
        ]);
        if (($request->visa_no == NULL) && ($request->mofa_no == NULL)) {
            notify()->error("Visa No and Mofa No Mendatory", "Error", "topRight");
            return redirect()->route('embassy.index');
        } else {
            $data               = Entry::findOrFail($request->id);
            $data->status       = $request->status;
            $data->updated_by   = logged_in_user_id();
            $success            = $data->save();
            if ($success) {
                notify()->success(updated_success(), "Success", "topRight");
            } else {
                notify()->error(exception(), "Error", "topRight");
            }
            return redirect()->route('manpower.index');
        }
    }
}
