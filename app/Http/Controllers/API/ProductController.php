<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Http\Requests\ProductStoreRequest;

class ProductController extends Controller
{
    public function index(ProductService $productService)
    {
        return $productService->getAllProducts();
    }

    public function show(ProductService $productService, $id)
    {
        return $productService->getProduct($id);
    }

    public function store(ProductStoreRequest $request, ProductService $productService)
    {
        $validatedData = $request->validated();
        return $productService->store($validatedData);
    }

    public function update(ProductStoreRequest $request, ProductService $productService, $id)
    {
        $validatedData = $request->validated();
        return $productService->update($validatedData, $id);
    }

    public function destroy(ProductService $productService, $id)
    {
        return $productService->destroy($id);
    }
}
