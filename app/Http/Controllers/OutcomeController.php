<?php

namespace App\Http\Controllers;

use App\Outcome;
use Illuminate\Http\Request;

class OutcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Outcome::all();
        return view('pages.outcome', ['data' => $data]);
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
            'price' => 'required|numeric|gte:1',
        ]);
        $outcome = new Outcome;
        $outcome->o_name = $request->name;
        $outcome->o_price = $request->price;
        $outcome->save();
        return redirect()->back()->withSuccess('Added Outcome Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Outcome  $outcome
     * @return \Illuminate\Http\Response
     */
    public function show(Outcome $outcome)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Outcome  $outcome
     * @return \Illuminate\Http\Response
     */
    public function edit(Outcome $outcome)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outcome  $outcome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outcome $outcome)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|gte:1',
        ]);
        $outcome->o_name = $request->name;
        $outcome->o_price = $request->price;
        $outcome->save();
        return redirect()->back()->withSuccess('Updated Outcome Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Outcome  $outcome
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outcome $outcome)
    {
        $outcome->delete();
        return redirect()->back()->withSuccess('Deleted Outcome Successfully !');

    }
}
