<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lek;

class LekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $lekovi = Lek::orderBy('created_at', 'desc')->paginate(6);
      return view('lekovi.index', compact('lekovi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $lek = Lek::all();
    return view('lekovi.create', compact('lek'));
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
'naziv' => 'required',
'kolicina' => 'required'
]);

// upisujemo u bazu
$lek = new Lek;
$lek->naziv = $request->input('naziv');
$lek->kolicina = $request->input('kolicina');


// cuvamo poruku
$lek->save();

return redirect('/lekovi')->with('success', 'Dodat lek!');
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
      $lek = Lek::find($id);
    return view('lekovi.edit', compact('lek'));
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
'naziv' => 'required',
'kolicina' => 'required'

]);

// upisujemo u bazu
$lek = Lek::find($id);
$lek->naziv = $request->input('naziv');
$lek->kolicina = $request->input('kolicina');

// cuvamo poruku
$lek->save();

return redirect('/lekovi')->with('success', 'Izmenjen lek!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $lek = Lek::find($id);

$lek->delete();
return redirect('/lekovi')->with('success', 'Uspesno obrisano');
    }
}
