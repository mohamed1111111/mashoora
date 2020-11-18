<?php

namespace App\Http\Controllers;
use  App\Vendor;
use App\Http\Requests\WorkingHoursRequest;
use App\Http\Resources\Vendor as VendorResource;
use Illuminate\Http\Request;
use  Auth;
use DB;
use App\Session;
class WorkingHoursController extends Controller
{
  public function workingHourBookings()
    {
      $user_id = Auth::user()->id;
      // $vendor  = Vendor::where('user_id', $user_id)->first();
      $vendor = new VendorResource(Vendor::where('id',$user_id)->first());

      if(!$vendor){
        return response()->json(['status' => 'Not found'], 400);
                  }
      $hours = $vendor->working_hours;

      //https://laracasts.com/discuss/channels/laravel/add-time-data-format-to-date-time-format?fbclid=IwAR0_ngfT_lv8OgE14qclgHNv8u_9QzTVluJF-LdFtWajZUCSbZobRWcOSUo
      $data = [];
      $x=0;
      foreach ($hours as  $hour) {
      $session = Session::whereDate('date', $hour->day)
      ->whereTime('date','>=',$hour->from)
      ->whereTime(DB::raw('ADDTIME(date, TIME_TO_SEC(total_minutes))'),'<=',$hour->to)
      ->get();
      $data[$x]["id"] =  $hour->id ;
      $data[$x]["vendor_id"] =  $hour->vendor_id ;
      $data[$x]["day"] =  $hour->day ;
      $data[$x]["from"] =  $hour->from ;
      $data[$x]["to"] =  $hour->to ;
      $data[$x]["state"] =  $hour->state ;
      $data[$x]["Bookings"]     =  $session ;
      $x++;
      }
      return response()->json(['status' => 'Success', 'data' => $data],200);

    }

 public function show()
    {
      $user_id =  Auth::user()->id;
      $vendor  =  vendors::where('user_id', $user_id)->first();
      if(!$vendor){
        return response()->json(['status' => 'Not found'], 400);
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
       $user_id = Auth::user()->id;
       $vendor  = Vendor::where('user_id', $user_id)->first();
        if(!$vendor){
          return response()->json(['status' => 'Not found'],400);
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
        $user_id = Auth::user()->id;
        $vendor  = vendors::where('user_id', $user_id)->first();
        if(!$vendor){
          return response()->json(['status' => 'Not found'],400);
                    }
        $hours=$vendor->working_hours()->find($hours);
        if(!$hours){
          return response()->json(['status' => 'Not found'],400);
                    }

        $vendor->working_hours()->where('id',$hours)->update($request->all());
        return response()->json(['status' => 'Success'],200);


      }
    public function destroy()
      {
        $user_id = Auth::user()->id;
        $vendor  = Vendor::where('user_id', $user_id)->first();
        if(!$vendor)
        {
        return response()->json(['status' => 'Not found'],400);
        }
        $vendor->working_hours()->delete();
        return response()->json(['status' => 'Success'],200);


      }

}
