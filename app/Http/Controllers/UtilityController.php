<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UtilityController extends Controller
{
    public static function GeneralResponse($status, $data) {
        return array("message"=>$status, "data"=>$data);
    }

    public static function search($table, Request $request) {
        $data = json_decode($request->input('data'));

        //return $data;
        $query = array();
        foreach ($data as $item) {
            array_push($query, array($item->column, $item->operator, $item->value));
        }

        array_push($query, array("deleted_at", "=", null));

        //return $query;

        return DB::table($table)->where($query)->paginate(2);
    }
}
