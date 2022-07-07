<?php

namespace  App\Repositories\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @var Product
     */
    protected $product;

    /**
     * ProductsRepository constructor.
     *
     */
    public function __construct()
    {
        $this->product = new Product();
    }

    /**
     * @return Product[]|Collection
     */
    public function getAll()
    {
        return $this->product->all();
    }

    /**
     * @param String $product_id
     * @return Product|Builder|Builder[]|Collection|Model
     */
    public function getOne(String $product_id)
    {
        return $this->product
                    ->query()
                    ->find($product_id);
    }

    /**
     * @param array $params
     *
     * @return mixed
     */
    public function create(array $params)
    {
        return $this->product
                    ->query()
                    ->create($params);
    }

    /**
     * @param Product $product
     * @param array            $params
     *
     * @return mixed
     */
    public function update(Product $product, array $params)
    {
        return $this->product
                    ->query()
                    ->find($product->id)
                    ->update($params);
    }

    /**
     * @param Product $product
     *
     * @return mixed
     */
    public function delete(Product $product)
    {
        return $this->product
                    ->query()
                    ->find($product->id)
                    ->delete();
    }
}
