<?php

namespace App\Http\Controllers;

use App\Buying;
use App\Product;
use App\Taxi;
use App\TaxiProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::with('taxis.taxi')->get();
        $taxi = Taxi::where('t_state', 1)->get();
        return view('pages.product', ['data' => $data, 'taxi' => $taxi]);
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
            'sell_price' => 'required|numeric|gte:1',
            'information' => 'sometimes|max:1000',
        ]);
        $product = new Product;
        $product->p_name = $request->name;
        $product->p_price_sell = $request->sell_price;
        $product->p_info = $request->information;
        $product->save();
        return redirect()->back()->withSuccess('Added Product Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $data = Buying::with(['product'])->get();
        $products = Product::all();
        return view('pages.buying', ['data' => $data, 'product' => $products, 'prod' => $product->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sell_price' => 'required|numeric|gte:1',
            'information' => 'sometimes|max:1000',
        ]);
        $product->p_name = $request->name;
        $product->p_price_sell = $request->sell_price;
        $product->p_info = $request->information;
        $product->save();
        return redirect()->back()->withSuccess('Updated Product Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect()->back()->withSuccess('Deleted Product Successfully !');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors('Maybe has relation !');
        }
    }
    public function send(Request $request, Product $product)
    {
        $request->validate([
            'amount' => 'required|numeric|lte:' . $product->p_amount,
            'taxi' => 'required|exists:taxis,id',
        ]);
        $product->p_amount = $product->p_amount - $request->amount;
        $product->save();
        $taxiproduct = TaxiProduct::where('tp_product', $product->id)->where('tp_taxi', $request->taxi)->first();
        
        if (is_null($taxiproduct)) {
            $taxiproduct = new TaxiProduct;
            $taxiproduct->tp_amount = $request->amount;
        }else{
            $taxiproduct->tp_amount = $request->amount + $taxiproduct->tp_amount;

        }
        $taxiproduct->tp_taxi = $request->taxi;
        $taxiproduct->tp_product = $product->id;
        $taxiproduct->save();
        return redirect()->back()->withSuccess('Added Product to Taxi Successfully !');
    }
    public function delete($id)
    {
        $taxiproduct = TaxiProduct::findOrFail($id);
        $product = Product::findOrFail($taxiproduct->tp_product);
        $product->p_amount = $product->p_amount + $taxiproduct->tp_amount;
        $product->save();
        $taxiproduct->delete();
        return redirect()->back()->withSuccess('Added Product to Taxi Successfully !');
    }
}
