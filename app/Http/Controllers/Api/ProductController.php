<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $q = Product::query();

        if ($type = request('type'))   $q->where('type', $type);
        if ($st   = request('status')) $q->where('status', $st);
        if ($s    = request('search')) $q->where(function($q) use ($s) {
            $q->where('title','like',"%$s%")
                ->orWhere('manufacturer','like',"%$s%");
        });

        return ProductResource::collection($q->latest()->paginate(12));
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }
}
