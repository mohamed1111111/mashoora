<?php

namespace App\Http\Controllers;
use Validator;
use App\Http\Requests\DocumentUploude;
use App\Filters\VendorFilters;
use Illuminate\Http\Request;
use Http\Requests;
use DB;
use App\Vendor;
use App\User;
use Auth;
class VendorController extends Controller
{
  public function index(VendorFilters $filters)
    {
        $vendors=Vendor::with('user')->filter($filters)->get();
        return response()->json(['Vendors' =>$vendors],200);

    }


    // public function vendors(Request $request){
    //   $vendors=Vendor::with('user')->filter($request)->get();
    //   return response()->json(['Vendors' =>$vendors],200);
    // }


    public function vendor($vendorId){
      $vendor=Vendor::where('id', $vendorId)->with(['work_experiences', 'working_hours','rates'])->get();
      if(!$vendor){
        return response()->json(['Status' => 'Vendor not found'],404);
        }
      return response()->json(['Vendor' =>$vendor],200);
    }

    public function storeDocument(DocumentUploude $request){
      $user_id=Auth::user()->id;
      $vendor=DB::table('vendors')->where('user_id', $user_id)->first();
       $vendor = Vendor::find($vendor->id);
      if(!$vendor){
        return response()->json(['Status' => 'Vendor not  found'], 404);
            }

        $certificate = time().''.rand().'.'.$request->certificate->extension();
        $request->certificate->move(public_path('vendor-documents'), $certificate);
        $vendor->certificate=$certificate;

        $idFront = time().''.rand().'.'.$request->id_front->extension();
        $request->id_front->move(public_path('vendor-documents'), $idFront);
        $vendor->id_front=$idFront;



        $idBack = time().''.rand().'.'.$request->id_back->extension();
        $request->id_back->move(public_path('vendor-documents'), $idBack);
        $vendor->id_back=$idBack;

        $vendor->save();
        return response()->json(['Status' => 'Documents  uplouded  succesfully']);

    }
}
