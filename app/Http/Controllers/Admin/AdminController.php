<?php

namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){

        $data['title'] = "Welcome to Khayer International";
        return view('admin.home.homeContent', $data);
    }


}//AdminController