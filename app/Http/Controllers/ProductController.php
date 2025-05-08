<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $products = $user->products()->get();
        return view('products.index', compact('products','user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $data = $request->validate([
                'pname' => 'required|string ',
                'price' => 'required|integer ',
                'category' => 'required|string',
                 

            ]);
            $data['quantity'] = 0;
            $data['user_id'] = auth()->id();
            $product = Product::create($data);
            return redirect()->route('products.index')->with('success', 'products created');
        } catch(\Exception $e){
            return back()->withErrors(['product', $e->getMessage()]);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
{
    if($product->user_id !== auth()->id()) {
        abort(403, 'Unauthorized');
    }
    
    return view('products.show', compact('product'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        if($product->user_id !== auth()->id()){
            abort(403, 'Unauthorized');
            $product ->roduct->toArray();
        }
            return view('products.edit', compact('product'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
{
    if($product->user_id !== auth()->id()) {
        abort(403, 'Unauthorized');
    }
    
    $request->validate([
        'pname' => 'required|string',
        'price' => 'required|integer',
        'category' => 'required|string',
         
    ]);
    
    $product->update($request->all());
    
    return redirect()->route('products.index')->with('success', 'Product updated');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if($product->user_id !==auth()->id()){
            abort(403,'unauthorized');
        }
            $product->delete();
            return redirect()->route('products.index')->with('success', 'deleted');
        
    }
}
