<?php

namespace App\Http\Controllers;

use App\Buying;
use App\Product;
use Illuminate\Http\Request;

class BuyingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Buying::with(['product'])->get();
        $product = Product::all();
        return view('pages.buying', ['data' => $data, 'product' => $product]);
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
            'document' => 'required|string|max:255',
            'amount' => 'required|numeric|gte:1',
            'price' => 'required|numeric|gte:1',
            'product' => 'required|exists:products,id',
        ]);
        $buying = new Buying;
        $buying->b_docment_id = $request->document;
        $buying->b_price = $request->price;
        $buying->b_all_price = $request->price *  $request->amount;
        $buying->b_amount = $request->amount;
        $buying->b_product = $request->product;
        $buying->save();
        $product = Product::findOrFail($request->product);
        $check = ($request->price > $product->p_price_buy);
        $product->p_price_buy =  $request->price;
        $product->p_amount = $product->p_amount + $request->amount;
        $product->save();
        return redirect()->back()->withSuccess($check ? 'Added Buying Successfully Please new Price is bigger than old Price check  <a href=' . route('product.index') . '> Link</a>' : 'Added Buying Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Buying  $buying
     * @return \Illuminate\Http\Response
     */
    public function show(Buying $buying)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Buying  $buying
     * @return \Illuminate\Http\Response
     */
    public function edit(Buying $buying)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Buying  $buying
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buying $buying)
    {
        $product = $buying->product;
        $p_amount_old = ($product->p_amount - $buying->b_amount) + $request->amount;
        $p_price_old = $product->p_price_buy;
        // dd($p_amount_old);

        if (!($p_amount_old >= 0)) {
            return redirect()->back()->withErrors('You Can not Edit This Buying Becouse Amount Wrong!');
        }
        $request->validate([
            'document' => 'required|string|max:255',
            'amount' => 'required|numeric|gte:1',
            'price' => 'required|numeric|gte:1',
        ]);

        $buying->b_docment_id = $request->document;
        $buying->b_price = $request->price;
        $buying->b_all_price = $request->price *  $request->amount;
        $buying->b_amount = $request->amount;
        $buying->save();
        $check = ($request->price > $product->p_price_buy);
        $product->p_price_buy =  $request->price;
        $product->p_amount = $p_amount_old;
        $product->save();
        return redirect()->back()->withSuccess($check ? 'Added Buying Successfully Please new Price is bigger than old Price check  <a href=' . route('product.index') . '> Link</a>' : 'Added Buying Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Buying  $buying
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buying $buying)
    {
        $product = Product::findOrFail($buying->b_product);
        if (($product->p_amount - $buying->b_amount) >= 0) {
            $product->p_amount = $product->p_amount - $buying->b_amount;
        } else {
            return redirect()->back()->withErrors('You Can not Delete This Buying !');
        }
        $product->save();
        try {
            $buying->delete();
            return redirect()->back()->withSuccess('Deleted Buying Successfully !');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors('Maybe has relation !');
        }
    }
}
