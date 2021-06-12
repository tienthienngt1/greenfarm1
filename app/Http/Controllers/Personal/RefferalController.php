<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cache\CacheController;
use Cache;

class RefferalController extends Controller
{
    use CacheController;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $refferals = Cache::get('refferals');
        $refferal1 = $refferals->filter(function($refferals){
            return $refferals->user_ref_1 == \Auth::user()->id;
        });
        $refferal2 = $refferals->filter(function($refferals){
            return $refferals->user_ref_2 == \Auth::user()->id;
        });
        return view('personal.gioithieu',[
            'historybuys' => $this->historybuyCache(),
            'refferal1' => $refferal1,
            'refferal2' => $refferal2,
        ]);
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
