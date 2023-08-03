<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use DB;

class LeaveRequestController extends Controller
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
    public function show(LeaveRequest $leaveRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveRequest $leaveRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeaveRequest $leaveRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveRequest $leaveRequest)
    {
        $leave = LeaveRequest::find($id);
        $leave->delete();
    }



/**************************API functions**********************************/
public function getAllLeaverequest(Request $request)
{
 
    try{
        $leave = DB::table('leave_requests as l')
        ->select('l.id','e.id as employee','t.name as type','l.request_on','l.dates','l.days','l.reason','l.status','u.name as aproved_by')
        ->leftjoin('employees as e','e.id','=','l.employee')
        ->leftjoin('leave_types as t','t.id','=','l.type')
        ->leftjoin('users as u','u.id','=','l.aproved_by');
        
        $search = $request->search;

        if (!is_null($search)){
            $leave = $leave->where('l.employee','LIKE','%'.$search.'%')
            ->orWhere('l.type','LIKE','%'.$search.'%')
            ->orWhere('l.request_on','LIKE','%'.$search.'%')
            ->orWhere('l.dates','LIKE','%'.$search.'%')
            ->orWhere('l.days','LIKE','%'.$search.'%')
            ->orWhere('l.reason','LIKE','%'.$search.'%')
            ->orWhere('l.status','LIKE','%'.$search.'%')
            ->orWhere('l.aproved_by','LIKE','%'.$search.'%');
        }
        $leave = $leave->orderBy('l.id','desc')->get();

        return response()->json([
            "message" => "leave request Data",
            "data" => $leave,
        ],200);
    }catch(\Throwable $e){
        return response()->json([
            "message"=>"oops something went wrong",
            "error"=> $e->getMessage(),
        ],500);
    }
}

public function getLeaverequest($id)
{
    try{

        $leave = DB::table('leave_requests as l')
        ->select('l.id','e.id as employee','t.name as type','l.request_on','l.dates','l.days','l.reason','l.status','u.name as aproved_by')
        ->leftjoin('employees as e','e.id','=','l.employee')
        ->leftjoin('leave_types as t','t.id','=','l.type')
        ->leftjoin('users as u','u.id','=','l.aproved_by')
        ->where('l.id',$id)
        ->first();

        return response()->json([
            "message" => "allowed leave Data",
            "data" => $leave,
        ],200);
    }catch(\Throwable $e){
        return response()->json([
            "message"=>"oops something went wrong",
            "error"=> $e->getMessage(),
        ],500);
    }
}

public function saveLeaverequest(Request $request)
{
    DB::beginTransaction();
    try{

    $leave = new LeaveRequest();
    $leave->employee = $request->employee;
    $leave->type = $request->type;
    $leave->request_on = $request->request_on;
    $leave->dates = $request->dates;
    $leave->days = $request->days;
    $leave->reason = $request->reason;
    $leave->status = $request->status;
    $leave->aproved_by = $request->aproved_by;
    $leave->save();

    DB::commit();

    return response()->json([
        "msg" => "leave Data",
        "data"=> $leave,
    ],201);
}catch(\Throwable $e) {
    DB::rollback();
    return response()->json([
        "msg"=>"oops something went wrong",
        "error"=> $e->getMessage(),
    ],500);
}
}

public function updateLeaverequest(Request $request, $id)
{
    DB::beginTransaction();
    try{

    $leave = LeaveRequest::find($id);
    $leave->employee = $request->employee;
    $leave->type = $request->type;
    $leave->dates = $request->dates;
    $leave->days = $request->days;
    $leave->reason = $request->reason;
    $leave->status = $request->status;
    $leave->aproved_by = $request->aproved_by;
    $leave->save();
 
  DB::commit();

  return response()->json([
    "msg" => "leave Data",
    "data"=> $leave,
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
