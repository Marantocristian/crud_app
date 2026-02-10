<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    protected ProductService $productService;


    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    public function index(Request $request): View
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }


    public function create(): View
    {
        return view('products.create');
    }


    public function store(StoreProductRequest $request): RedirectResponse
    {
        try {
            $product = $this->productService->createProduct($request->validated());

            return redirect()->route('products.index')
                ->with('success', "Producto '{$product->name}' creado exitosamente.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al crear el producto: ' . $e->getMessage());
        }
    }


    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }


    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }


    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        try {
            $updatedProduct = $this->productService->updateProduct($product, $request->validated());

            return redirect()->route('products.index')
                ->with('success', "Producto '{$updatedProduct->name}' actualizado exitosamente.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al actualizar el producto: ' . $e->getMessage());
        }
    }


    public function destroy(Product $product): RedirectResponse
    {
        try {
            $productName = $product->name;
            $this->productService->deleteProduct($product);

            return redirect()->route('products.index')
                ->with('success', "Producto '{$productName}' eliminado exitosamente.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al eliminar el producto: ' . $e->getMessage());
        }
    }
}
