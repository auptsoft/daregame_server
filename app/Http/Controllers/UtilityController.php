<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Category;
use App\User;

class UtilityController extends Controller
{
    public static function GeneralResponse($status, $data) {
        return array("message"=>$status, "data"=>$data);
    }

    public static function search($table, Request $request) {
        $data = json_decode($request->input('data'));

       
        $query = array();
        //return $data;
        foreach ($data as $item) {
            //if (!$item->value) {
              //  array_push($query, array($item->column, $item->operator, null));
            //}
        }
        //return "hello";
        //array_push($query, array("deleted_at", "=", null));

        //return $query;

        //return DB::table($table)->where($query)->paginate(2);

        //$categories = Category::all();

        return UtilityController::GeneralResponse("success", DB::table($table)->where($query)->get());
    }
}
