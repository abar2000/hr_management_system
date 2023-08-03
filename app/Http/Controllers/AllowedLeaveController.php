<?php

namespace App\Http\Controllers;

use App\Models\AllowedLeave;
use Illuminate\Http\Request;
use DB;

class AllowedLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AllowedLeave $allowedLeave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AllowedLeave $allowedLeave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AllowedLeave $allowedLeave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $allowedleave = AllowedLeave::find($id);
        $allowedleave->delete();
    }




/**************************API functions**********************************/
public function getAllAllowedleaves(Request $request)
{
 
    try{
        $allowed = DB::table('allowed_leaves as a')
        ->select('a.id','p.id as position','l.name as type','a.days','a.term')
        ->leftjoin('positions as p','p.id','=','a.position')
        ->leftjoin('leave_types as l','l.id','=','a.type');
        
        $search = $request->search;

        if (!is_null($search)){
            $allowed = $allowed->where('a.position','LIKE','%'.$search.'%')
            ->orWhere('a.type','LIKE','%'.$search.'%')
            ->orWhere('a.days','LIKE','%'.$search.'%')
            ->orWhere('a.term','LIKE','%'.$search.'%');
        }
        $allowed = $allowed->orderBy('a.id','desc')->get();

        return response()->json([
            "message" => "allowed leaves Data",
            "data" => $allowed,
        ],200);
    }catch(\Throwable $e){
        return response()->json([
            "message"=>"oops something went wrong",
            "error"=> $e->getMessage(),
        ],500);
    }
}

public function getAllowedleaves($id)
{
    try{

        $allowed = DB::table('allowed_leaves as a')
        ->select('a.id','p.id as position','l.name as type','a.days','a.term')
        ->leftjoin('positions as p','p.id','=','a.position')
        ->leftjoin('leave_types as l','l.id','=','a.type')
        ->where('a.id',$id)
        ->first();

        return response()->json([
            "message" => "allowed leave Data",
            "data" => $allowed,
        ],200);
    }catch(\Throwable $e){
        return response()->json([
            "message"=>"oops something went wrong",
            "error"=> $e->getMessage(),
        ],500);
    }
}

public function saveAllowedleaves(Request $request)
{
    DB::beginTransaction();
    try{

    $allowed = new AllowedLeave();
    $allowed->position = $request->position;
    $allowed->type = $request->type;
    $allowed->days = $request->days;
    $allowed->term = $request->term;
    $allowed->save();

    DB::commit();

    return response()->json([
        "msg" => "allowed leave Data",
        "data"=> $allowed,
    ],201);
}catch(\Throwable $e) {
    DB::rollback();
    return response()->json([
        "msg"=>"oops something went wrong",
        "error"=> $e->getMessage(),
    ],500);
}
}

public function updateAllowedleaves(Request $request, $id)
{
    DB::beginTransaction();
    try{

    $allowed = AllowedLeave::find($id);
    $allowed->position = $request->position;
    $allowed->type = $request->type;
    $allowed->days = $request->days;
    $allowed->term = $request->term;
    $allowed->save(); 
 
  DB::commit();

  return response()->json([
    "msg" => "short leave Data",
    "data"=> $allowed,
],201);
}catch(\Throwable $e) {
DB::rollback();
return response()->json([
    "msg"=>"oops something went wrong",
    "error"=> $e->getMessage(),
],500);
}
}

}
