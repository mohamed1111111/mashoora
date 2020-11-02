<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Vendor;
use App\Http\Requests\ExperiencesRequest;
class ExperiencesController extends Controller
{
  public function show($id)
  {
      $vendor = Vendor::find($id);
      if(!$vendor){
        return response()->json(['status' => 'Not found'], 404);

      }
      $experiances = $vendor->work_experiences;
      return response()->json(['status' => 'Success', 'data' => $experiances]);

  }
  public function create()
  {
      //
  }
  public function store(ExperiencesRequest $request,$id)
  {
    $vendor = Vendor::find($id);
    if(!$vendor){
      return response()->json(['status' => 'Not found'],404);
                }

      $vendorExperiance=$vendor->work_experiences()->create($request->all());
      return response()->json(['status' => 'Success', 'data' => $vendorExperiance]);

  }
  public function edit($id)
  {
      //
  }
  public function update(ExperiencesRequest $request, $id)
  {

    $vendor = Vendor::find($id);
    if(!$vendor){
      return response()->json(['status' => 'Not found'],404);
                }
    $vendor->work_experiences()->update($request->all());
    return response()->json(['status' => 'Success'],200);


  }
  public function destroy($id)
  {
    $vendor = Vendor::find($id);
    if(!$vendor){
      return response()->json(['status' => 'Not found'],404);
                }
    $vendor->work_experiences()->delete();

    return response()->json(['status' => 'Success'],200);


  }

}
