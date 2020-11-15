<?php

namespace App\Http\Controllers;
use  App\Vendor;
use App\Http\Requests\WorkingHoursRequest;
use Illuminate\Http\Request;
use  Auth;
use DB;
class WorkingHoursController extends Controller
{
   public function show()
    {
      $user_id=Auth::user()->id;
      $vendor=DB::table('vendors')->where('user_id', $user_id)->first();
      if(!$vendor){
        return response()->json(['status' => 'Not found'], 404);
                  }
      $hours = $vendor->working_hours;
      return response()->json(['status' => 'Success', 'data' => $hours],200);

     }
   public function create()
     {
      //
     }
   public function store(WorkingHoursRequest $request)
     {
       $user_id=Auth::user()->id;
       $vendor=Vendor::where('user_id', $user_id)->first();
        if(!$vendor){
          return response()->json(['status' => 'Not found'],404);
                    }
        $vendorHours=$vendor->working_hours()->create($request->all());
        return response()->json(['status' => 'Success', 'data' => $vendorHours]);

      }
    public function edit($id)
      {
      //
      }
    public function update(Request $request,$hours)
     {
        $user_id=Auth::user()->id;
        $vendor=DB::table('vendors')->where('user_id', $user_id)->first();
        if(!$vendor){
          return response()->json(['status' => 'Not found'],404);
                    }
        $hours=$vendor->working_hours()->find($hours);
        if(!$hours){
          return response()->json(['status' => 'Not found'],404);
                    }

        $vendor->working_hours()->where('id',$hours)->update($request->all());
        return response()->json(['status' => 'Success'],200);


      }
    public function destroy()
      {
        $user_id=Auth::user()->id;
        $vendor=DB::table('vendors')->where('user_id', $user_id)->first();
        if(!$vendor)
        {
        return response()->json(['status' => 'Not found'],404);
        }
        $vendor->working_hours()->delete();
        return response()->json(['status' => 'Success'],200);


      }

}
