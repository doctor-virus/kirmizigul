<?php

namespace App\Http\Controllers;

use App\Selling;
use App\Taxi;
use App\TaxiProduct;
use Illuminate\Http\Request;

class SellingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = TaxiProduct::with(['taxi.city', 'product'])->orderBy('updated_at', 'DESC')->get();
        return view('pages.selling', ['data' => $data]);
        // return  ;
    }
    public function income()
    {
        $data = Selling::with(['taxi','product'])->where('s_state',1)->get();
        return view('pages.income',['data'=>$data]);
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
        $data = TaxiProduct::findOrFail($request->id);
        $request->validate([
            'amount' => 'required|numeric|gt:0|lte:'.$data->tp_amount ,
            'price' => 'required|numeric|gte:1',
            'address' => 'sometimes|max:1000',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:17',
            'state' => 'required|in:0,1',
            'id' => 'required|exists:taxi_products,id',
        ]);
        $data->tp_amount = $data->tp_amount - $request->amount;
        $data->save();
        $selling = new Selling;
        $selling->s_amount = $request->amount;
        $selling->s_name = $request->name;
        $selling->s_phone = $request->phone;
        $selling->s_price = $request->price;
        $selling->s_all_price = $request->price * $request->amount;
        $selling->s_taxi = $data->tp_taxi;
        $selling->s_product = $data->tp_product;
        $selling->s_address = $request->address;
        $selling->s_state = $request->state;
        $selling->save();
        return redirect()->back()->withSuccess('Creat Order Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Selling  $selling
     * @return \Illuminate\Http\Response
     */
    public function show(Selling $selling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Selling  $selling
     * @return \Illuminate\Http\Response
     */
    public function edit(Selling $selling)
    {
        $selling->s_state = !$selling->s_state;
        $selling->save();
        return redirect()->back()->withSuccess('Done Order Successfully !');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Selling  $selling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Selling $selling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Selling  $selling
     * @return \Illuminate\Http\Response
     */
    public function destroy(Selling $selling)
    {
        $tproduct = TaxiProduct::where('tp_taxi',$selling->s_taxi)->where('tp_product',$selling->s_product)->first();
        $tproduct->tp_amount = $tproduct->tp_amount +  $selling->s_amount;
        $tproduct->save();
        try {
            $selling->delete();
            return redirect()->back()->withSuccess('Canceled Order Successfully !');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors('Maybe has relation !');
        }
    }
}
