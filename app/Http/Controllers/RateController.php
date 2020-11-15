<?php

namespace App\Http\Controllers;
use App\Http\Requests\RatingRequest;
use App\Rate;
use Auth;
use  DB;
use App\Vendor;
use Illuminate\Http\Request;

class RateController extends Controller
{
  public function customerRate(RatingRequest $request,$enrollmentId)
  {
    $user_id=Auth::user()->id;
    $customer=DB::table('customers')->where('user_id',$user_id)->first();
    $enrollment=DB::table('enrollments')->where('id',$enrollmentId)->where('customer_id',$customer->id)->first();
    if(!$enrollment){
      return response()->json(['status' => 'Sorry, you are not allowed '],404);
    }
    $session=DB::table('sessions')->where('id', $enrollment->session_id)->first();

    if(!$session){
      return response()->json(['status' => 'Sorry, you are not allowed '],404);
    }

    if($enrollment->status != "completed"){
      return response()->json(['status' => 'Sorry,  your enrollment is not completed '],404);
    }
    $enrollRate=DB::table('rates')->where([
                                            ['vendor_id','=', $session->vendor_id],
                                            ['customer_id','=',$customer->id],
                                            ['enrollment_id','=',$enrollment->id]])->first();
    if($enrollRate){
      return response()->json(['status' => 'Sorry,  your rate already sent'],404);
    }
    $rate = Rate::create(([
        'customer_id'=>$customer->id
        , 'vendor_id'=>$session->vendor_id
        , 'enrollment_id'=>$enrollmentId
        , 'stars'=>$request->get('stars')
        , 'comment'=>$request->get('comment')
     ]));
     $vendor=Vendor::where('id',$session->vendor_id)->first();
     $stars=$request->get('stars');
     $vendorRating = $vendor->rating;
     if($vendorRating==null){
        $vendor->rating=$stars;
     }
     else {
       $vendor->rating = ($vendorRating+$stars)/2;
     }
     $totalReviews = $vendor->total_reviews;
     $vendor->total_reviews = $totalReviews + 1;
     $vendor->save();
     $rate->save();
     return response()->json(['status' => 'Success'],200);

  }
}
