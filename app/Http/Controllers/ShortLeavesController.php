<?php

namespace App\Http\Controllers;

use App\Models\ShortLeaves;
use Illuminate\Http\Request;
use DB;

class ShortLeavesController extends Controller
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
    public function show(ShortLeaves $shortLeaves)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShortLeaves $shortLeaves)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShortLeaves $shortLeaves)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $short = ShortLeaves::find($id);
        $short->delete();
    }




   /**************************API functions**********************************/
   public function getAllShortleaves(Request $request)
   {
    
       try{
           $short = DB::table('short_leaves as s')
           ->select('s.id','e.id as employee','s.date','s.time_from','s.time_to','s.note')
           ->leftjoin('employees as e','e.id','=','s.employee');
           
           $search = $request->search;

           if (!is_null($search)){
               $salary = $salary->where('s.employee','LIKE','%'.$search.'%')
               ->orWhere('s.date','LIKE','%'.$search.'%')
               ->orWhere('s.time_from','LIKE','%'.$search.'%')
               ->orWhere('s.time_to','LIKE','%'.$search.'%')
               ->orWhere('s.note','LIKE','%'.$search.'%');
           }
           $short = $short->orderBy('s.id','desc')->get();

           return response()->json([
               "message" => "Short leaves Data",
               "data" => $short,
           ],200);
       }catch(\Throwable $e){
           return response()->json([
               "message"=>"oops something went wrong",
               "error"=> $e->getMessage(),
           ],500);
       }
   }

   public function getShortleaves($id)
   {
       try{

           $short = DB::table('short_leaves as s')
           ->select('s.id','e.id as employee','s.date','s.time_from','s.time_to','s.note')
           ->leftjoin('employees as e','e.id','=','s.employee')
           ->where('s.id',$id)
           ->first();

           return response()->json([
               "message" => "Short leave Data",
               "data" => $short,
           ],200);
       }catch(\Throwable $e){
           return response()->json([
               "message"=>"oops something went wrong",
               "error"=> $e->getMessage(),
           ],500);
       }
   }

   public function saveShortleaves(Request $request)
   {
       DB::beginTransaction();
       try{

       $short = new ShortLeaves();
       $short->employee = $request->employee;
       $short->date = $request->date;
       $short->time_from = $request->time_from;
       $short->time_to = $request->time_to;
       $short->note = $request->note;
       $short->save();

       DB::commit();

       return response()->json([
           "msg" => "Short leave Data",
           "data"=> $short,
       ],201);
   }catch(\Throwable $e) {
       DB::rollback();
       return response()->json([
           "msg"=>"oops something went wrong",
           "error"=> $e->getMessage(),
       ],500);
   }
   }

   public function updateShortleaves(Request $request, $id)
   {
       DB::beginTransaction();
       try{

       $short = ShortLeaves::find($id);
       $short->employee = $request->employee;
       $short->date = $request->date;
       $short->time_from = $request->time_from;
       $short->time_to = $request->time_to;
       $short->note = $request->note;
       $short->save(); 
    
     DB::commit();

     return response()->json([
       "msg" => "short leave Data",
       "data"=> $short,
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
