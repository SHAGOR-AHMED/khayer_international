<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\User;
use App\Models\Agent;
use App\Models\Entry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){

        $data['title'] = "Welcome to Khayer International";
        $data['total_user'] = User::where('type','!=','user')->get();
        $data['total_agent'] = Agent::get();
        $data['total_client'] = User::where('type','user')->get();
        $data['total_entry'] = Entry::get();
        return view('admin.home.homeContent', $data);
    }


}//AdminController