<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'status'       => 'required|in:in_stock,preorder',
            'type'         => 'required|in:fuel,oil,air,pump',
            'power'        => 'nullable|integer',
            'img'          => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product added successfully!');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'status'       => 'required|in:in_stock,preorder',
            'type'         => 'required|in:fuel,oil,air,pump',
            'power'        => 'nullable|integer',
            'img'          => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('img')) {
            if ($product->img) {
                Storage::disk('public')->delete($product->img);
            }
            $data['img'] = $request->file('img')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->img) {
            Storage::disk('public')->delete($product->img);
        }
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted!');
    }
}
