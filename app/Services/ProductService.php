<?php

namespace App\Services;

use App\Http\Requests\ProductUpdateOrCreateRequest;
use App\Models\Product;
use App\Repositories\Product\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use JetBrains\PhpStorm\Pure;

class ProductService
{
    /**
     * @var $productRepository
     */
    protected $productRepository;

    /**
     * ProductService constructor.
     */
    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    /**
     * @return Product[]|Collection
     */
    public function getProducts()
    {
        return $this->productRepository->getAll();
    }

    /**
     * @param String $product_id
     * @return mixed
     */
    public function show(String $product_id)
    {
        return $this->productRepository->getOne($product_id);
    }

    /**
     * @param ProductUpdateOrCreateRequest $request
     */
    public function create(ProductUpdateOrCreateRequest $request) {
        $this->productRepository->create($this->productTableData($request));
    }

    /**
     * @param ProductUpdateOrCreateRequest $request
     * @param Product $product
     */
    public function update(ProductUpdateOrCreateRequest $request, Product $product) {
        $this->productRepository->update($product, $this->productTableData($request));
    }

    /**
     * @param Product $product
     */
    public function delete(Product $product)
    {
        $this->productRepository->delete($product);
    }

    /**
     * @param $request
     * @return array
     */
    protected function productTableData($request): array
    {
        return [
            'name' => $request->input('name'),
            'short_name' => $request->input('short_name'),
            'quantity' => $request->input('quantity'),
            'price' => convertToChangePrice($request->input('price')),
            'last_price' => convertToChangePrice($request->input('last_price')),
            'currency' => $request->input('currency')
        ];
    }
}
