<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users= User::orderBy('created_at', 'desc')->paginate(6);
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
      $user = User::find($id);   // traxi id iz show i smesta u note
return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $roles = Role::all();
  $user = User::find($id);
    return view('users.edit', compact('roles', 'user'));
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
      $this->validate($request, [
    'name' => 'required|min:2|max:30|regex:/^[A-Za-z ]*$/i',
      'email' => 'required|email',
      'role_id' => 'required'
]);

// upisujemo u bazu
$user = User::find($id);
$user->name = $request->input('name');
$user->email = $request->input('email');
$user->role_id = $request->input('role_id');

// cuvamo poruku
$user->save();

return redirect('/admin')->with('success', 'Azuriran korisnik!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::find($id);

$user->delete();
return redirect('/admin')->with('success', 'Uspesno obrisano');
    }
}
