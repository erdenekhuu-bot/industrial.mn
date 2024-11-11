<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Setting;
use App\Models\Background;
use DB;

class SwipperBackground extends Controller
{
    public function index(Request $request){
        
        return response()->json(['success'=>true, 'data'=>Background::all()]);
    }

    public function create(Request $request, Background $model){
        
        return response()->json(['success'=>true]);
    }

    public function find($name): Response
    {
        $query=DB::table('settings')->where('type',$name)->get();
        return response()->json(['data'=>$query]);
    }
    
    public function remove($id){
        $query=DB::table('backgrounds')->where('id', $id)->delete();
        return response()->json(['success'=>true]);
    }
}
