<?php

namespace App\Http\Controllers;

use App\Outcome;
use App\Product;
use App\Selling;
use App\Taxi;
use App\TaxiProduct;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outcome = Outcome::sum('o_price');
        $income = Selling::sum('s_all_price');
        $earn = $income - $outcome;
        $taxi = Taxi::where('t_state', 1)->count();
        $pending = Selling::where('s_state', 1)->count();
        $done = Selling::where('s_state', 0)->count();
        $product =  Product::count();
        $tproduct = TaxiProduct::sum('tp_amount');
        return view('pages.report', [
            'taxi' => $taxi,
            'pending' => $pending,
            'done' => $done,
            'product' => $product,
            'tproduct' => $tproduct,
            'earn' => $earn,
            'income' => $income,
            'outcome' => $outcome
        ]);
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
            'from' => 'required|date',
            'to' => 'required|date',
        ]);
        $outcome = Outcome::whereBetween('created_at', [$request->from, $request->to])->sum('o_price');
        $income = Selling::whereBetween('created_at', [$request->from, $request->to])->sum('s_all_price');
        $earn = $income - $outcome;
        $taxi = Taxi::whereBetween('created_at', [$request->from, $request->to])->where('t_state', 1)->count();
        $pending = Selling::whereBetween('created_at', [$request->from, $request->to])->where('s_state', 1)->count();
        $done = Selling::whereBetween('created_at', [$request->from, $request->to])->where('s_state', 0)->count();
        $product =  Product::whereBetween('created_at', [$request->from, $request->to])->count();
        $tproduct = TaxiProduct::whereBetween('created_at', [$request->from, $request->to])->sum('tp_amount');
        return view('pages.report', [
            'taxi' => $taxi,
            'pending' => $pending,
            'done' => $done,
            'product' => $product,
            'tproduct' => $tproduct,
            'earn' => $earn,
            'income' => $income,
            'outcome' => $outcome,
            'from'=>$request->from,
            'to'=>$request->to,
        ]);
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
