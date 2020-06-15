<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pacijent;
use Auth;
use Illuminate\Support\Facades\DB;

class LekarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user_id = Auth::user()->id;
          $user = User::find($user_id);

         $pacijenti = $user->pacijenti('pacijenti')->paginate(6);
        return view('lekar',  compact('pacijenti'));
    }

    public function searchPacijent(Request $request){
        $search = $request->get('searchdoktorovpacijent');

        $user_id = Auth::user()->id;

        $pacijenti = Pacijent::where('user_id', 'like', $user_id)->where(
            function ($query) use ($search){
              $query->where('ime', 'like', '%' .$search. '%')
                ->orWhere(DB::raw('concat(ime," ",prezime)'), 'like', '%' .$search. '%')
                ->orWhere(DB::raw('concat(prezime," ",ime)'), 'like', '%' .$search. '%')
                ->orWhere('prezime', 'like', '%' .$search. '%');
            })->paginate(6);

        return view('lekar', compact('pacijenti'));
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
      $pacijent = Pacijent::find($id);
return view('pacijenti.showdoktor', compact('pacijent'));
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
