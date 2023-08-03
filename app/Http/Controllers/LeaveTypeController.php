<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Request;
use DB;
class LeaveTypeController extends Controller
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
    public function show(LeaveType $leaveType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveType $leaveType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeaveType $leaveType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $leaveType = LeaveType::find($id);
        $leaveType->delete();
    }



  /**************************API functions**********************************/
  public function getAllLeaveType(Request $request,)
  {
   
      try{
          $leavetype = DB::table('leave_types as l')
          ->select('l.id','l.name','l.is_no_pay','l.description');
     
          $search = $request->search;
          if (!is_null($search)){
              $leavetype = $leavetype
              ->where('l.name','LIKE','%'.$search.'%')
              ->orWhere('l.is_no_pay','LIKE','%'.$search.'%')
              ->orWhere('l.description','LIKE','%'.$search.'%');
          }
          $leavetype = $leavetype->orderBy('l.id','desc')->get();

          return response()->json([
              "message" => "Leave Types Data",
              "data" => $leavetype,
          ],200);
      }catch(\Throwable $e){
          return response()->json([
              "message"=>"oops something went wrong",
              "error"=> $e->getMessage(),
          ],500);
      }
  }

  public function getLeaveTypeInfo($id)
  {
      try{

            $leavetype = DB::table('leave_types as l')
            ->select('l.id','l.name','l.is_no_pay','l.description')
            ->where('l.id',$id)
             ->first();

          return response()->json([
              "message" => "Selected leaave Type's  Data",
              "data" => $leavetype,
          ],200);
      }catch(\Throwable $e){
          return response()->json([
              "message"=>"oops something went wrong",
              "error"=> $e->getMessage(),
          ],500);
      }
  }

  public function saveLeaveType(Request $request)
  {
      DB::beginTransaction();
      try{
     

      $leavetype = new LeaveType();
      $leavetype->name = $request->name;
      $leavetype->is_no_pay = $request->is_no_pay;
      $leavetype->description = $request->description;
      $leavetype->save();

      DB::commit();

      return response()->json([
          "msg" => "Saved leavetype Data",
          "data"=> $leavetype,
      ],201);
  }catch(\Throwable $e) {
      DB::rollback();
      return response()->json([
          "msg"=>"oops something went wrong",
          "error"=> $e->getMessage(),
      ],500);
  }
  }

  public function updateLeaveType(Request $request, $id)
  {
      DB::beginTransaction();
      try{
     

      $leavetype = LeaveType::find($id);
      $leavetype->name = $request->name;
      $leavetype->is_no_pay = $request->is_no_pay;
      $leavetype->description = $request->description;
      $leavetype->save(); 
   
    DB::commit();

    return response()->json([
      "msg" => "Updated leavetype Data",
      "data"=> $leavetype,
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

