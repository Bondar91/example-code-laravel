<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    protected $productService;

    /**
     * ProductController constructor.
     *
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product)
    {
        return response()->json([
            'status' => true,
            'data' => $product
        ], Response::HTTP_OK);
    }

    /**
     * @return JsonResponse
     */
    public function getProducts()
    {
        $products = $this->productService->getProducts();

        return response()->json([
            'status' => true,
            'data' => $products
        ], Response::HTTP_OK);
    }
}
