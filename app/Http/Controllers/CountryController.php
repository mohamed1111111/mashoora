<?php

namespace App\Http\Controllers;
use App\Http\Requests\CountryRequest;
use  App\Country;
use Validator;

use Illuminate\Http\Request;
class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        return response()->json(['status' => 'Success', 'data' => $countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {

        $country=new Country();
        $country->code=$request->get('code');
        $country-> name_ar=$request->get('name_ar');
        $country->name_en=$request->get('name_ar');
        $country->state=$request->get('state');
        $country->save();
        return response()->json(['status' => 'Success', 'data' => $country]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = Country::find($id);
        return response()->json(['status' => 'Success', 'data' => $country]);
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
    public function update(CountryRequest $request, $id)
    {

       $country = Country::find($id);

         $country->code = $request->get('code');
         $country->name_ar = $request->get('name_ar');
         $country->name_en = $request->get('name_en');
         $country->state = $request->get('state');
         $country->save();
        return response()->json(['status' => 'Success',$country]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::find($id);
        $country->delete();
        return response()->json(['status' => 'Success', 'Message' => 'Country Deleted']);
    }
}
