<?php

namespace App\Http\Controllers;
use Validator;
use App\Http\Requests\DocumentUploude;

use Illuminate\Http\Request;
use App\Vendor;
class VendorController extends Controller
{
    public function storeDocument(DocumentUploude $request,$id)
    {

       $vendor = Vendor::find($id);
      if(!$vendor){
        return response()->json(['error' => 'Vendor not  found'], 404);
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
        return response()->json(['Success' => 'Documents  uplouded  succesfully']);


    }
}
