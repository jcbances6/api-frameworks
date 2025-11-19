<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::with('category')->get();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        //
        $validated = $request->validated();

        try{
            $product = Product::create($validated);
            return response()->json($product, 201);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product = Product::with('category')->find($id);
        if ($product) {
            return response()->json($product);
        } else {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        //
        $validated = $request->validated();

        try{
            $product = Product::findOrFail($id);
            $product->update($validated);
            return response()->json($product);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Producto eliminado'], 200);

    }

    public function findByName(Request $request)
    {
        $name = $request->query('name');
        $products = Product::where('name', 'like', '%' . $name . '%')->with('category')->get();
        return response()->json($products);
    }
}
