<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dijagnoza;
use Illuminate\Support\Facades\DB;

class DijagnozaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dijagnoze = Dijagnoza::orderBy('created_at', 'desc')->paginate(6);
        return view('dijagnoze.index', compact('dijagnoze'));
    }

    public function searchDijagnoza(Request $request){
        $search = $request->get('searchdijagnoza');
        $dljagnoze = DB::table('dijagnozas')->where('naziv', 'like', '%' .$search. '%')->paginate(6);
        return view('dijagnoze.index', compact('dijagnoze'));
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dijagnoza = Dijagnoza::all();
        return view('dijagnoze.create', compact('dijagnoza'));
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
            'naziv' => 'required'
            ]);

            // upisujemo u bazu
            $dijagnoza = new Dijagnoza;
            $dijagnoza->naziv = $request->input('naziv');


            // cuvamo poruku
            $dijagnoza->save();

            return redirect('/dijagnoze')->with('success', 'Dodata dijagnoza!');
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
        $dijagnoza = Dijagnoza::find($id);
    return view('dijagnoze.edit', compact('dijagnoza'));
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
            'naziv' => 'required'

            ]);

            // upisujemo u bazu
            $dijagnoza = Dijagnoza::find($id);
            $dijagnoza->naziv = $request->input('naziv');

            // cuvamo poruku
            $dijagnoza->save();

            return redirect('/dijagnoze')->with('success', 'Izmenjen podatak o dijagnozi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dijagnoza = Dijagnoza::find($id);

$dijagnoza->delete();
return redirect('/dijagnoze')->with('success', 'Uspesno obrisano');
    }
}
