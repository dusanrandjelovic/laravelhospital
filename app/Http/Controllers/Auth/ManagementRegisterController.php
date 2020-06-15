<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class ManagementRegisterController extends Controller
{

    public function __construct()
    {
      //  $this->middleware('guest:web');
    }

    public function showRegistrationForm()
    {
          $roles=Role::all();
        return view('auth.management-register', compact('roles'));
    }

  /*  public function register(Request $request){

            $this->validate($request, [
              'name' => 'required',
              'email' => 'required',
              'password' => 'required',
              'password_confirmation' => 'required|same:password'
            ]);
          $admin = new Admin;
          $admin->name = $request->input('name');  // vracamo ime iz input
          $admin->email = $request->input('email');
          $admin->password = $request->input('password');
          $admin->save();

          return redirect()->intended(route('admin.login'));

        }*/


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'password' => ['required', 'string', 'min:8', 'confirmed'],
          'role_id' => ['required', 'string', 'max:2'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
  /*  protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }*/

    protected function createManagement(Request $request){
      $this->validator($request->all())->validate();
      User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role_id' => $request->role_id,
      ]);
      return redirect()->intended(route('admin'))->with('success', 'Kreiran korisnik');
    }
}
