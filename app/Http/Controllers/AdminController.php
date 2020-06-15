<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pacijent;
use Illuminate\Support\Facades\DB;
use Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  $users= User::orderBy('created_at', 'desc')->paginate(6);
      $pacijenti = Pacijent::count();
  //    $doktori = User::count()->where('role_id', '=', '2')->get();
   $doktori = User::where('role_id', '=', '2')->count();
      $asistenti = User::where('role_id', '=', '3')->count();
        return view('admin', compact('pacijenti', 'doktori', 'asistenti'));
    }

// kad imam relaciju moram ici preko modela, ne DB
    public function searchUser(Request $request){
       $search = $request->get('searchuser');
        $users = User::where('name', 'like', '%' .$search. '%')->paginate(6);
        return view('users.index', compact('users'));
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
    public function store(Request $request)
    {
        //
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
