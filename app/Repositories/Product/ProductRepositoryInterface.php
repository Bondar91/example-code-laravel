<?php

namespace  App\Repositories\Product;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function getAll();

    /**
     * @param String $product_id
     * @return mixed
     */
    public function getOne(String $product_id);

    /**
     * @param array $params
     *
     * @return mixed
     */
    public function create(array $params);

    /**
     * @param \App\Models\Product $product
     * @param array            $params
     *
     * @return mixed
     */
    public function update(Product $product, array $params);

    /**
     * @param \App\Models\Product $product
     *
     * @return mixed
     */
    public function delete(Product $product);
}
