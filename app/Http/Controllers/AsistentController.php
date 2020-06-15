<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pacijent;
use App\Karton;
use App\Lek;
use App\Dijagnoza;
use Illuminate\Support\Facades\DB;

class AsistentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $pacijenti = Pacijent::orderBy('created_at', 'desc')->paginate(6);
//  $doktor = Doktor::all();
     return view('asistent', compact('pacijenti'));
    }

    public function sviKartoni(){
  $kartoni = Karton::orderBy('created_at', 'desc')->paginate(6);
  return view('kartoni.index', compact('kartoni'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pacijenti = Pacijent::all();
  $lekovi = Lek::all();
    return view('kartoni.create', compact('pacijenti'));
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
            'pacijent_id' => 'required'
            ]);

            // upisujemo u bazu
            if(isset($karton->lekovi)){
             $lekoviString = implode(",", $request->get('lekovi'));
            } else {
              $lekoviString = 0;
            }
            if(isset($karton->dijagnoze)){
                $dijagnozeString = implode(",", $request->get('dijagnoze'));
               } else {
                 $dijagnozeString = 'Nema dijagnoze';
               }
            $karton = new Karton;
            $karton->opis = $request->input('opis');
            $karton->datum = $request->input('datum');
            $karton->pacijent_id = $request->input('pacijent_id');
            $karton->lekovi = $lekoviString;
            $karton->dijagnoze = $dijagnozeString;

            // cuvamo poruku
            $karton->save();

            return redirect('/kartoni')->with('success', 'Kreiran karton!');
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
    return view('kartoni.showasistent', compact('karton'));
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
        $karton = Karton::find($id);

$karton->delete();
return redirect('/kartoni')->with('success', 'Uspesno obrisano');
    }

    public function searchLek(Request $request){
        $search = $request->get('searchlek');
        $lekovi = DB::table('leks')->where('naziv', 'like', '%' .$search. '%')->paginate(6);
        return view('lekovi.index', compact('lekovi'));
      }


      public function searchPacijentKarton(Request $request){
              $search = $request->get('searchpacijentkarton');
              $pacijenti = Pacijent::where('ime', 'like', '%' .$search. '%')
              ->orWhere('prezime', 'like', '%' .$search. '%')
              ->orWhere(DB::raw('concat(ime," ",prezime)'), 'like', '%' .$search. '%')
              ->orWhere(DB::raw('concat(prezime," ",ime)'), 'like', '%' .$search. '%')->paginate(6);
              return view('/kartoni/create', compact('pacijenti'));
            }

            public function searchKarton(Request $request){
                $search = $request->get('searchkarton');
                $kartoni = Karton::where('id', 'like', '%' .$search. '%')->paginate(6);
                return view('kartoni.index', compact('kartoni'));
              }


}
