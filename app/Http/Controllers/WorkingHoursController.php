<?php

namespace App\Http\Controllers;
use  App\Vendor;
use App\Http\Requests\WorkingHoursRequest;
use Illuminate\Http\Request;

class WorkingHoursController extends Controller
{
   public function show($id)
  {
  $vendor = Vendor::find($id);
  if(!$vendor){
    return response()->json(['status' => 'Not found'], 404);
              }
  $hours = $vendor->working_hours;
  return response()->json(['status' => 'Success', 'data' => $hours]);

  }
public function create()
{
  //
}
public function store(WorkingHoursRequest $request,$id)
{
$vendor = Vendor::find($id);
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
public function update(Request $request, $vendor,$hours)
{

$vendor = Vendor::find($vendor);
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
public function destroy($id)
{
$vendor = Vendor::find($id);
if(!$vendor){
  return response()->json(['status' => 'Not found'],404);
            }
$vendor->working_hours()->delete();

return response()->json(['status' => 'Success'],200);


}

}
