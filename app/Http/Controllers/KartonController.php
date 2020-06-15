<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karton;
use App\User;
use App\Lek;
use App\Dijagnoza;
use Auth;


class KartonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $karton = Karton::find($id);
        return view('kartoni.show', compact('karton'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = Auth::user()->id;
  $user = User::find($user_id);

  $pacijenti = $user->pacijenti;
  $karton = Karton::find($id);
  $lekovi = Lek::where('kolicina', '=', '1')->get();
  $dijagnoze = Dijagnoza::all();
        return view('kartoni.edit', compact('karton', 'pacijenti', 'lekovi', 'dijagnoze'));
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
            'opis' => 'required',
            'datum' => 'required'
         //   'pacijent_id' => 'required'
    ]);

    // upisujemo u bazu

    // $lekoviString = implode(",", $request->get('lekovi'));
    if (!empty($request->get('lekovi'))) {
        $lekoviString = implode(',', $request->get('lekovi'));
     } else {
        $lekoviString = '';
     }
     
      if (!empty($request->get('dijagnoze'))) {
        $dijagnozeString = implode(',', $request->get('dijagnoze'));
     } else {
        $dijagnozeString = '';
     }

    $karton = Karton::find($id);
    $karton->opis = $request->input('opis');
    $karton->datum = $request->input('datum');
    $karton->pacijent_id = $request->input('pacijent_id');
    $karton->lekovi = $lekoviString;
    $karton->dijagnoze = $dijagnozeString;
    // cuvamo poruku
    $karton->save();

    return redirect('/lekar')->with('success', 'Azuriran karton!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $karton = Karton::find($id);

        $karton->delete();
        return redirect('/lekar')->with('success', 'Uspesno obrisano');
    }
}
