<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Material;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequests\ProductStoreRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $materials = Material::all();
        return view('production.product.index', compact('products', 'materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $productStoreRequest)
    {

        $validated = $productStoreRequest->validated();
        $name = $validated['name'];
        $price = $validated['price'];


        $image = $productStoreRequest->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $imagePath = 'images/' . $imageName;


        $product = Product::create([
            'name' => $name,
            'price' => $price,
            'image' => $imagePath,
            'slug' => Str::slug($name)
        ]);

        foreach ($productStoreRequest->validated()['materials'] as $material) {

            $materialData = Material::find($material['id'])->deliveryNoteMaterials->first();
            
            $product->materials()->attach($material['id'], [
                'value' => $material['quantity'],
                'unit' => $materialData ? $materialData->unit : null
            ]);
        }

        return redirect()->route('production.product.index')->with([
            'status' => 'success',
            'message' => "$product->name has been created!"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
