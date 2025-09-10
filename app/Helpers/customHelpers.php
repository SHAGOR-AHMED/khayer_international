<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;
use Vinkla\Hashids\Facades\Hashids;

if (!function_exists('hashid_encode')) {

    function hashid_encode($id){
        return Hashids::encode($id);
    }
}

if (!function_exists('hashid_decode')) {
    
    function hashid_decode($hashid){
        $decoded = Hashids::decode($hashid);
        return $decoded[0] ?? null; // return null if not valid
    }
}

// Check exist data
function existed($tableName = NULL, $fieldName = NULL, $value = NULL) {

    $query = DB::table($tableName)
            ->select($fieldName)
            ->where($fieldName,$value)
            ->first();
    if ($query)
        return true;
    else
        return false;
}

if (!function_exists('logged_in_user_id')) {

    function logged_in_user_id(){

        $logged_in_id = '';
        $logged_in_id = Auth::user()->id;
        return $logged_in_id;
    }
}

if (!function_exists('logged_in_user_name')) {

    function logged_in_user_name(){

        $logged_in_name = '';
        $logged_in_name = Auth::user()->name;
        return $logged_in_name;
        // return auth()->check() ? auth()->user()->name : 'Guest';
    }
}

if (!function_exists('logged_in_role_id')) {

    function logged_in_role_id(){

        $logged_in_role_id = 0;
        if (Auth::user()->role_id) :
            $logged_in_role_id = Auth::user()->role_id;
        endif;
        return $logged_in_role_id;
    }
}

// Create a slug
function slug($str=NULL)
{
    return str_replace(' ', '-' , $str);
}

// Auto id generate with prefix
function make_id($tableName = NULL, $fieldName = NULL, $prefix = NULL) {
    $row = DB::table($tableName)
            ->select($fieldName)
            ->orderby($fieldName, 'DESC')
            ->limit(1)
            ->first();
	if (isset($row)) {
		$lastId = $row->$fieldName;
		$restId = str_replace($prefix, '', $lastId);
		$newId = $prefix . sprintf("%06d", ($restId + 1));
	} else {
		$iniId = 1;
		$newId = $prefix . sprintf("%06d", $iniId);
	}
	return $newId;
	//echo make_id('tableName', 'fieldName', 'prefix');
}

// Compare date month year  
$timezone = "Asia/Dhaka";
if(function_exists('date_default_timezone_set')) {

    date_default_timezone_set($timezone);

    // Difference between day
    function diff_day($sDay, $eDay)
    {
        $sDay = new DateTime(date($sDay));
        $eDay = new DateTime(date($eDay));
        return  $eDay->diff($sDay)->d;
        // Call this function diff_day($v1, $v2);
    }
    
    // Remaining Days
    function remaining_days($date=NULL)
    {
        if(date('Y-m-d')<$date) {
            $date = new DateTime($date);
            $now = new DateTime();
            $diff = $date->diff($now);
            return '<span class="green">Remaining Days: '.$diff->days.'</span>';
        }
        else {
            return '<span class="red"> Date Expired </span>';
        }
        // Cal this fuction as remaining_days('Y-m-d');
    }
}

if (!function_exists('setMessage')) {

    function setMessage($key, $class, $message){

        session()->flash($key, $message);
        session()->flash("class", $class);
        return true;
    }
}

if (!function_exists('debug_r')) {

    function debug_r($value){

        echo "<pre>";
        print_r($value);
        echo "</pre>";
        die();
    }
}

if (!function_exists('debug_v')) {

    function debug_v($value){

        echo "<pre>";
        var_dump($value);
        echo "</pre>";
        die();
    }
}

if (!function_exists('getGender')) {

    function getGender($value)
    {
        switch($value){
            case 1:
                return "Male";
            case 2:
                return "Female";
        }
    }
}

function imageShow($image)
{
    if ($image) {
        if (file_exists(public_path($image))) {
            return asset($image);
        } else {
            return asset('admin/img/unknown.png');
        }
    } else {
        return asset('admin/img/unknown.png');
    }
}

function imageDeleteManager($old_image)
{
    if (file_exists($old_image)) {
        @unlink($old_image);
    }
}

function limit_words($string, $wordsreturned) {
    
    $string = strip_tags($string); // Remove html tag
    $retval = $string; //   Just in case of a problem
    $array = explode(" ", $string);
    /*  Already short enough, return the whole thing */
    if (count($array) <= $wordsreturned) {
        $retval = $string;
    }
    /*  Need to chop of some words */ 
    else {
        array_splice($array, $wordsreturned);
        $retval = implode(" ", $array) . " ......";
    }
    return $retval;
    //echo read_more('word' , 'number');
}