<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pacijent;
use App\User;
use App\Karton;
use Illuminate\Support\Facades\DB;

class PacijentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function searchPacijent(Request $request){
      $search = $request->get('searchpacijent');
      $pacijenti = Pacijent::where('ime', 'like', '%' .$search. '%')
      ->orWhere(DB::raw('concat(ime," ",prezime)'), 'like', '%' .$search. '%')
      ->orWhere(DB::raw('concat(prezime," ",ime)'), 'like', '%' .$search. '%')
      ->orWhere('prezime', 'like', '%' .$search. '%')->paginate(6);
      return view('asistent', compact('pacijenti'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $pacijent = Pacijent::all();
    $users = User::where('role_id', '=', '2')->get();
      return view('pacijenti.create', compact('pacijent', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
    'ime' => 'required|min:2|max:30|regex:/^[A-Za-z ]*$/i',
    'prezime' => 'required|min:2|max:30|regex:/^[A-Za-z ]*$/i',
    'pol' => 'required',
    'datum_rodjenja' => 'required',
    'adresa' => 'required',
    'user_id' => 'required'
]);

// upisujemo u bazu
$pacijent = new Pacijent;
$pacijent->ime = $request->input('ime');
$pacijent->prezime = $request->input('prezime');
$pacijent->pol = $request->input('pol');
$pacijent->datum_rodjenja = $request->input('datum_rodjenja');
$pacijent->adresa = $request->input('adresa');
$pacijent->user_id = $request->input('user_id');

// cuvamo poruku
$pacijent->save();

return redirect('/asistent')->with('success', 'Kreiran pacijent!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $users = User::where('role_id', '=', '2')->get();
$karton = Karton::find($id);
$pacijent = Pacijent::find($id);
return view('pacijenti.show', compact('users', 'pacijent', 'karton'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $users = User::where('role_id', '=', '2')->get();
    $pacijent = Pacijent::find($id);
      return view('pacijenti.edit', compact('users', 'pacijent'));
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
    'ime' => 'required|min:2|max:30|regex:/^[A-Za-z ]*$/i',
      'prezime' => 'required|min:2|max:30|regex:/^[A-Za-z ]*$/i',
      'pol' => 'required',
      'datum_rodjenja' => 'required',
      'adresa' => 'required',
      'user_id' => 'required'
]);

// upisujemo u bazu
$pacijent = Pacijent::find($id);
$pacijent->ime = $request->input('ime');
$pacijent->prezime = $request->input('prezime');
$pacijent->pol = $request->input('pol');
$pacijent->datum_rodjenja = $request->input('datum_rodjenja');
$pacijent->adresa = $request->input('adresa');
$pacijent->user_id = $request->input('user_id');

// cuvamo poruku
$pacijent->save();

return redirect('/asistent')->with('success', 'Azuriran pacijent!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $pacijent = Pacijent::find($id);

$pacijent->delete();
return redirect('/asistent')->with('success', 'Uspesno obrisano');
    }
}
