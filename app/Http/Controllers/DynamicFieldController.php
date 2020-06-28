<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\DynamicField;
class DynamicFieldController extends Controller
{
    function index()
    {
     return view('ppiket.dynamic.dynamic_field');

    }

    function insert(Request $request)
    {
     if($request->ajax())
     {
      $rules = array(
       'first_name.*'  => 'required',
       'last_name.*'  => 'required'
      );
      $error = Validator::make($request->all(), $rules);
      if($error->fails())
      {
       return response()->json([
        'error'  => $error->errors()->all()
       ]);
      }

      $first_name = $request->first_name;
      $last_name = $request->last_name;
      for($count = 0; $count < count($first_name); $count++)
      {
       $data = array(
        'first_name' => $first_name[$count],
        'last_name'  => $last_name[$count]
       );
       $insert_data[] = $data; 
      }

      DynamicField::insert($insert_data);
      return response()->json([
       'success'  => 'Data Added successfully.'
      ]);
     }
    }

}
