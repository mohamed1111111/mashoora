<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateAdminRequest;
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Http\Request;
use App\User;
use DataTables;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('admins.index');
    }
    //getall addmins  to datatable
    public function getAdmins()
    {
      $admins = User::select(['name','email','phone_number'])->where('type',1);

      return Datatables::of($admins)->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" class="edit btn btn-info btn-sm">View</a>';
                           $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                           $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-danger btn-sm">Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $roles = Role::pluck('name','name')->all();
      return view('admins.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAdminRequest $request)
    {
      $validated=$request->validated();
      $user=User::create([
        'name'=>$request->get('name')
        , 'email'=>$request->get('email')
        , 'phone_number'=>$request->get('phone_number')
        , 'type'=>'1'
        ,'password'=>bcrypt($request['password'])
        ,'confirm_password'=>bcrypt($request['confirm_password'])
      ]);
      $user->admin()->create($validated);

      $user->save();
      return redirect()->route('admins')
          ->with('success', 'Product created successfully.');
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
