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

        $data['title'] = "Welcome to A Khayer International";
        $data['total_user'] = User::where('type','!=','user')->count();
        $data['total_agent'] = Agent::count();
        $data['total_client'] = User::where('type','user')->count();
        $data['total_entry'] = Entry::count();
        return view('admin.home.homeContent', $data);
    }


}//AdminController