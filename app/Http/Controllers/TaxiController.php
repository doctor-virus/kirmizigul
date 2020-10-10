<?php

namespace App\Http\Controllers;

use App\City;
use App\Taxi;
use App\TaxiProduct;
use Illuminate\Http\Request;

class TaxiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  Taxi::with('city')->get();
        $city =  City::all();
        return view('pages.taxi', ['data' => $data,'city' => $city]);
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
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:17|unique:taxis,t_phone',
            'city' => 'required|exists:cities,id',
            'state' => 'sometimes|in:on,null',
        ]);
        $taxi = new Taxi;
        $taxi->t_name = $request->name;
        $taxi->t_phone = $request->phone;
        $taxi->t_city = $request->city;
        $taxi->t_state = $request->state == 'on' ? 1 : 0;
        $taxi->save();
        return redirect()->back()->withSuccess('Added Taxi Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Taxi  $taxi
     * @return \Illuminate\Http\Response
     */
    public function show(Taxi $taxi)
    {
        $data = TaxiProduct::with('product')->where('tp_taxi',$taxi->id)->get();
        return view('pages.show',['data'=>$data,'taxi'=>$taxi]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Taxi  $taxi
     * @return \Illuminate\Http\Response
     */
    public function edit(Taxi $taxi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Taxi  $taxi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Taxi $taxi)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:17|unique:taxis,t_phone,'. $taxi->id,
            'city' => 'required|exists:cities,id',
            'state' => 'sometimes|in:on,null',
        ]);
        $taxi->t_name = $request->name;
        $taxi->t_phone = $request->phone;
        $taxi->t_city = $request->city;
        $taxi->t_state = $request->state == 'on' ? 1 : 0;
        $taxi->save();
        return redirect()->back()->withSuccess('Updated Taxi Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Taxi  $taxi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Taxi $taxi)
    {
        try {
            $taxi->delete();
            return redirect()->back()->withSuccess('Deleted Taxi Successfully !');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors('Maybe has relation !');
        }
    }
}
