<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $products = \App\Models\Product::where('user_id', $user_id)->get();

        return response()->json([
            'products' => $products,
            'message' => 'Products retrieved successfully',
            'status' => true
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            "title" => "required|string|max:255",
        ]);
        $data['user_id'] = auth()->user()->id;
        if ($request->hasFile('banner_image')) {
            $data['banner_image'] = $request->file('banner_image')->store('products', 'public');
        }

        Product::create($data);

        return response()->json([
            'message' => 'Product created successfully',
            'status' => true
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json([
            'product' => $product,
            'message' => 'Product retrieved successfully',
            'status' => true
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return response()->json([
            'product' => $product,
            'message' => 'Product retrieved successfully',
            'status' => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            "title" => "required|string|max:255",
        ]);

        if ($request->hasFile('banner_image')) {

            if($product->banner_image) {
                // Delete the old banner image if it exists
                \Storage::disk('public')->delete($product->banner_image);
            }

            $data['banner_image'] = $request->file('banner_image')->store('products', 'public');
            $product->update($data);

            return response()->json([
                'message' => 'Product updated successfully',
                'status' => true
            ]);
        }

        $product->update($data);

        return response()->json([
            'message' => 'Product updated successfully',
            'status' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
            'status' => true
        ]);
    }
}
