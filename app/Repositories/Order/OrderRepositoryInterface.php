<?php

namespace  App\Repositories\Order;

use App\Models\Order;
use App\Models\Product;

interface OrderRepositoryInterface
{
    public function getAll();

    /**
     * @param $params
     *
     * @return mixed
     */
    public function getOrdersByFilter($params);

    /**
     * @param Int $order_id
     *
     * @return mixed
     */
    public function getOne(Int $order_id);

    /**
     * @param String $order_uuid
     *
     */
    public function getOrderByUuid(String $order_uuid);

    /**
     * @param array $params
     *
     * @return mixed
     */
    public function create(array $params);

    /**
     * @param Order $order
     * @param Product $product
     * @param $coupon
     * @return mixed
     */
    public function attachProduct(Order $order, Product $product, $coupon);

    /**
     * @param \App\Models\Order   $order
     * @param \App\Models\Product $product
     * @param                     $data
     *
     * @return mixed
     */
    public function attachProductByAdmin(Order $order, Product $product, $data);

    /**
     * @param \App\Models\Order $order
     * @param array            $params
     *
     * @return mixed
     */
    public function update(Order $order, array $params);

    /**
     * @param \App\Models\Order $order
     *
     * @return mixed
     */
    public function delete(Order $order);

    /**
     * @param array $idsToDelete
     * @return mixed
     */
    public function deleteMany(array $idsToDelete);
}
