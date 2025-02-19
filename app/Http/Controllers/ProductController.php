<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Material;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequests\ProductStoreRequest;
use App\Http\Requests\ProductRequests\ProductUpdateRequest;

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

        $image = $productStoreRequest->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $imagePath = 'images/' . $imageName;

        $product = Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'image' => $imagePath,
            'slug' => Str::slug($validated['name']),
        ]);

        foreach ($validated['materials'] as $material) {

            $materialData = Material::find($material['id'])->deliveryNoteMaterials->first();

            $product->materials()->attach($material['id'], [
                'value' => $material['quantity'],
                'unit' => $materialData->unit ?? null
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
    public function update(ProductUpdateRequest $productUpdateRequest, Product $product)
    {
        $validated = $productUpdateRequest->validated();
        if ($productUpdateRequest->hasFile('image')) {
            $image = $productUpdateRequest->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        }

        $syncData = [];

        foreach ($validated['materials'] as $material) {
            $materialData = Material::find($material['id'])->deliveryNoteMaterials->first();

            $syncData[$material['id']] = [
                'value' => $material['quantity'],
                'unit' => $materialData->unit ?? null
            ];
        }

        $product->materials()->sync($syncData);

        return redirect()->route('production.product.index')->with([
            'status' => 'success',
            'message' => "$product->name has been updated!"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }
        $product->delete();

        return redirect()->route('production.product.index')->with([
            'status' => 'success',
            'message' => "Product has been deleted!"
        ]);
    }
}
