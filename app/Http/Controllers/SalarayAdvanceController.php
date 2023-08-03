<?php

namespace App\Http\Controllers;

use App\Models\SalarayAdvance;
use Illuminate\Http\Request;
use DB;
class SalarayAdvanceController extends Controller
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
    public function show(SalarayAdvance $salarayAdvance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalarayAdvance $salarayAdvance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalarayAdvance $salarayAdvance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $salary = SalarayAdvance::find($id);
        $salary->delete();
    }





    /**************************API functions**********************************/
    public function getAllSalaryAdvance(Request $request)
    {
     
        try{
            $salary = DB::table('salaray_advances as s')
            ->select('s.id','e.bio_code as bio_code','s.amount','s.type','s.from_date','s.to_date','s.description','s.status')
            ->leftjoin('employees as e','e.id','=','s.bio_code');
            
            $search = $request->search;

            if (!is_null($search)){
                $salary = $salary->where('s.bio_code','LIKE','%'.$search.'%')
                ->orWhere('s.amount','LIKE','%'.$search.'%')
                ->orWhere('s.type','LIKE','%'.$search.'%')
                ->orWhere('s.from_date','LIKE','%'.$search.'%')
                ->orWhere('s.to_date','LIKE','%'.$search.'%')
                ->orWhere('s.description','LIKE','%'.$search.'%')
                ->orWhere('s.status','LIKE','%'.$search.'%');
            }
            $salary = $salary->orderBy('s.id','desc')->get();

            return response()->json([
                "message" => "Salary Data",
                "data" => $salary,
            ],200);
        }catch(\Throwable $e){
            return response()->json([
                "message"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
    }

    public function getSalaryAdvance($id)
    {
        try{

            $salary = DB::table('salaray_advances as s')
            ->select('s.id','e.bio_code as bio_code','s.amount','s.type','s.from_date','s.to_date','s.description','s.status')
            ->leftjoin('employees as e','e.id','=','s.bio_code')
            ->where('s.id',$id)
            ->first();

            return response()->json([
                "message" => "Salary Data",
                "data" => $salary,
            ],200);
        }catch(\Throwable $e){
            return response()->json([
                "message"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
    }

    public function saveSalaryAdvance(Request $request)
    {
        DB::beginTransaction();
        try{

        $salary = new SalarayAdvance();
        $salary->bio_code = $request->bio_code;
        $salary->amount = $request->amount;
        $salary->type = $request->type;
        $salary->from_date = $request->from_date;
        $salary->to_date = $request->to_date;
        $salary->description = $request->description;
        $salary->status = $request->status;
        $salary->save();

        DB::commit();

        return response()->json([
            "msg" => "Salary Data",
            "data"=> $salary,
        ],201);
    }catch(\Throwable $e) {
        DB::rollback();
        return response()->json([
            "msg"=>"oops something went wrong",
            "error"=> $e->getMessage(),
        ],500);
    }
    }

    public function updateSalaryAdvance(Request $request, $id)
    {
        DB::beginTransaction();
        try{

        $salary = SalarayAdvance::find($id);
        $salary->bio_code = $request->bio_code;
        $salary->amount = $request->amount;
        $salary->type = $request->type;
        $salary->from_date = $request->from_date;
        $salary->to_date = $request->to_date;
        $salary->description = $request->description;
        $salary->status = $request->status;
        $salary->save(); 
     
      DB::commit();

      return response()->json([
        "msg" => "salary Data",
        "data"=> $salary,
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
