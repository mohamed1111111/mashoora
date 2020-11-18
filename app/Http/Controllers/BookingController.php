<?php

namespace App\Http\Controllers;
use  App\Session;
use  App\Enrollment;
use Illuminate\Http\Request;
use Auth;
use App\Vendor;
use DB;
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $sessions = Session::with(' ')->get();
      return response()->json(['status' => 'Success', 'data' => $sessions],200);
    }


 public function vendorBookingList(){
      $user_id=Auth::user()->id;
      $vendor=DB::table('vendors')->where('user_id', $user_id)->first();
      $sessionsEnrollments=Session::where('vendor_id', $vendor->id)->with('enrollments.customer.user')->get();
      // $enrollmentsCustomer=Enrollment::with('customer')->get();
      if(!$sessionsEnrollments){
        return response()->json(['status' => 'There is no enrollments'],404);
        }
        return response()->json(['Sessions'=>$sessionsEnrollments],200);
    }

    public function clientBookingList(){
      $user_id=Auth::user()->id;
      // $vendorId=DB::table('vendors')->where('user_id', $user_id)->first();
      $customerId=DB::table('customers')->where('user_id', $user_id);
      // $sessionsEnrollments=Session::where('vendor_id', $vendorId->id)->with('enrollments.customer.user')->get();
      $enrollmentsCustomer=Enrollment::with('session.vendor.user')->get();
      if(!$enrollmentsCustomer){
        return response()->json(['status' => 'There is no enrollments'],404);
        }
        return response()->json(['Sessions'=>$enrollmentsCustomer],200);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function customerBook(Request $request,$vendorId)
    {

        $user_id=Auth::user()->id;
        $customer=DB::table('customers')->where('user_id', $user_id)->first();
        $vendor=DB::table('vendors')->where('id', $vendorId)->first();
        $hourPrice=$vendor->hour_price;
        $totalMin=$request->get('total_minutes');
        $price=($totalMin*$hourPrice)/60;
        $session = Session::create(([
          'title'=>$request->get('title'),
          'total_minutes'=>$request->get('total_minutes')
          ,'vendor_id'=>$vendorId
          , 'price'=>$price
          , 'date'=>$request->get('date')

        ]));
        $session->enrollments()->create([
        'customer_id'=>$customer->id,
        'status'=>"pending",
        ]);
        $session->save();
        return response()->json(['Status' => 'Success'],200);

    }
    public function vendorAccept($enrollment)
    {
      $enroll=Enrollment::find($enrollment);
      $user_id=Auth::user()->id;
      $sessionID=$enroll->session_id;
      $vendor=DB::table('vendors')->where('user_id', $user_id)->first();
      // $vendor=Vendor::find()->where('user_id',$user_id);
      if(!$vendor){
        return response()->json(['Status' => 'faild'],404);

      }
      $session=Session::find($sessionID)->where('vendor_id',$vendor->id);
      if(!$session){
        return response()->json(['Status' => 'faild'],404);

      }
        $enroll->status="waiting payment";
        $enroll->save();
        return response()->json(['Status' => 'Success'],200);

    }

    public function vendorReject(Request  $request,$enrollment)
    {
      $enroll=Enrollment::find($enrollment);
      $user_id=Auth::user()->id;
      if($enroll->status!="pending"){
        if($enroll->status=="cancelled"){
          return response()->json(['Status' => 'Sorry, already cancelled by client'],400);
        }
        if($enroll->status=="rejected"){
          return response()->json(['Status' => 'Sorry, already rejected'],400);
          }
        return response()->json(['Status' => 'Sorry, session in proccesing or completed'],400);
      }
      $sessionId=$enroll->session_id;
      //$vendor=DB::table('vendors')->where('user_id', $user_id)->first();
      $vendor=Vendor::find()->where('user_id',$user_id)->first();
      if(!$vendor){
        return response()->json(['Status' => 'faild'],404);

      }
      $session=Session::find($sessionId)->where('vendor_id',$vendor->id)->first();
      if(!$session){
        return response()->json(['Status' => 'faild'],404);
      }
      $enroll->status="rejected";
      $enroll->rejected_reason=$request->rejected_reason;
      $enroll->save();
      return response()->json(['Status' => 'Success'],200);

    }


    public function clientCancell($enrollment){

      $user_id=Auth::user()->id;
      $customer=DB::table('customers')->where('user_id', $user_id)->first();
      if(!$customer){
        return response()->json(['status' => 'faild'],404);
      }
      $enroll=Enrollment::find($enrollment)->where('customer_id',$customer->id)->first();
      if(!$enroll){
        return response()->json(['status' => 'Enrollment does not exist'],404);
        }
      elseif($enroll->status!="pending"){
        if($enroll->status=="rejected"){
          return response()->json(['status' => 'Sorry, already rejected by doctor'],400);
          }
          if($enroll->status=="cancelled"){
            return response()->json(['status' => 'Sorry, already cancelled'],400);
            }
          return response()->json(['status' => 'Sorry, session in proccesing or completed'],400);
          }
      $enroll->status="cancelled";
      $enroll->save();
      return response()->json(['status' => 'Success'],200);
    }


        // public function clientCancell($enrollment){
        //
        //   $user_id=Auth::user()->id;
        //   $customer=DB::table('customers')->where('user_id', $user_id)->first();
        //   if(!$customer){
        //     return response()->json(['status' => 'faild'],404);
        //   }
        //   $enroll=Enrollment::find($enrollment)->where('customer_id',$customer->id)->first();
        //   if(!$enroll){
        //     return response()->json(['status' => 'Enrollment does not exist'],404);
        //     }
        //   elseif($enroll->status!="pending"){
        //     if($enroll->status=="rejected"){
        //       return response()->json(['status' => 'Sorry, already rejected by doctor'],404);
        //       }
        //       if($enroll->status=="cancelled"){
        //         return response()->json(['status' => 'Sorry, already cancelled'],404);
        //         }
        //       return response()->json(['status' => 'Sorry you can not do this'],404);
        //       }
        //   $enroll->status="cancelled";
        //   $enroll->save();
        //   return response()->json(['status' => 'Success'],200);
        // }


        public function enrollmentProccessing($enrollment){
          $user_id=Auth::user()->id;
          $customer=DB::table('customers')->where('user_id', $user_id)->first();
          if(!$customer){
            return response()->json(['status' => 'faild'],404);
          }
          $enroll=Enrollment::find($enrollment)->where('customer_id',$customer->id)->first();
          if(!$enroll){
            return response()->json(['status' => 'Enrollment does not exist'],404);
            }
          elseif($enroll->status!="pending"){
            if($enroll->status=="rejected"){
              return response()->json(['status' => 'Sorry, already rejected by doctor'],400);
              }
              if($enroll->status=="cancelled"){
                return response()->json(['status' => 'Sorry, already cancelled'],400);
                }
              if($enroll->status=="completed"){
                  return response()->json(['status' => 'Sorry, already completed'],400);
                  }
              return response()->json(['status' => 'Sorry you can not do this'],404);
              }
          $enroll->status="proccesing";
          $enroll->save();
          return response()->json(['status' => 'Success'],200);
        }


        public function enrollmentCompleted($enrollment){
          $enroll=Enrollment::find($enrollment);
          $user_id=Auth::user()->id;
          $sessionID=$enroll->session_id;
          $vendor=DB::table('vendors')->where('user_id', $user_id)->first();
          // $vendor=Vendor::find()->where('user_id',$user_id);
          if(!$vendor){
            return response()->json(['status' => 'faild'],404);

          }
          $session=Session::find($sessionID)->where('vendor_id',$vendor->id);
          if(!$session){
            return response()->json(['status' => 'faild'],404);

          }
            $enroll->status="completed";
            $enroll->save();
            return response()->json(['status' => 'Success'],200);
        }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
