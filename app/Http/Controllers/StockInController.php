<?php

namespace App\Http\Controllers;

use App\Models\StockIn;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StockInController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $stockIns = $user->stockIns()->with('product')->get();
        $products = $user->products()->get();
        return view('stockin.index', compact('stockIns', 'user', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stockIn.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        try{
            $data = $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
            ]);
            $product = Product::findOrFail($request->product_id);
            $total_price = $product->price *$request->quantity;
            $data['user_id'] = Auth::user()->id;
            $data['total_price'] = $total_price;

            $old_quantity = $product->quantity;
            $new_quantity = $request->quantity;
            $product->update(['quantity'=> $old_quantity + $new_quantity]);
            StockIn::create($data);
            return back()->with('success', 'product added');
           } catch(\Exception $e){
            dd($e->getMessage());
            return back()->withError('stockin', 'adding product failed');

           }
    }

    /**
     * Display the specified resource.
     */
    public function show(StockIn $stockIn)
    {
        if($stockin->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        return view('stockin.show', compact('stockIn'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockIn $stockin)
    {

        $user = Auth::user();
        $products = $user->products()->get();
        dd($stockIn);
        return view('stockin.edit', compact('stockin', 'products', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockIn $stockIn)
    {
        $request->validate([
            'product_id'=>'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);
        $product = Product::findOrFail($request->product_id);
        $total_price = $product->price * $product->quantity;
        $data->request->all();
        $data['total_price'] =$total_price;
        $product->update(['quantity'=>$request_>quantiy]);
        return redirect()->route('stockin.update', $stockIn->id)->with('success','stockin transaction recorded succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockIn $stockin)
    {
        // dd([
        //     'stock_in_id' => $stockin->id,
        //     'stock_in_user_id' => $stockin->user_id,
        //     'auth_user_id' => auth()->id(),
        //     'are_equal' => $stockin->user_id == auth()->id(),
        //     'strict_equal' => $stockin->user_id === auth()->id()
        // ]);

        if($stockin->user_id !==auth()->id()){
            abort(403, 'unauthorized');
        }
        $stockin->delete();
        return redirect()->route('stockin.index')->with('success', 'deleted successfully');

    }
}
