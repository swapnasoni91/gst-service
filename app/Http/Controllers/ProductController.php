<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // LIST PRODUCTS
    public function index()
    {
        $products = Product::where('user_id', Auth::id())
                    ->latest()
                    ->get();

        return view('products.index', compact('products'));
    }

    // CREATE FORM
    public function create()
    {
        return view('products.create');
    }

    // STORE PRODUCT
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'gst_percent' => 'required|numeric'
        ]);

        Product::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'gst_percent' => $request->gst_percent,
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product Created Successfully');
    }

    // EDIT FORM
    public function edit($id)
    {
        $product = Product::where('user_id', Auth::id())
                    ->findOrFail($id);

        return view('products.edit', compact('product'));
    }

    // UPDATE PRODUCT
    public function update(Request $request, $id)
    {
        $product = Product::where('user_id', Auth::id())
                    ->findOrFail($id);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'gst_percent' => $request->gst_percent,
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product Updated Successfully');
    }

    // DELETE PRODUCT
    public function destroy($id)
    {
        $product = Product::where('user_id', Auth::id())
                    ->findOrFail($id);

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product Deleted Successfully');
    }
}