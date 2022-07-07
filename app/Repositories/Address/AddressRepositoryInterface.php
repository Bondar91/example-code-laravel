<?php

namespace  App\Repositories\Address;

use App\Models\Address;

interface AddressRepositoryInterface
{
    /**
     * @param array $params
     *
     * @return mixed
     */
    public function create(array $params);

    /**
     * @param Address $address
     * @param array $params
     * @return mixed
     */
    public function update(Address $address, array $params);
}
