<?php

namespace App\Repositories\Address;

use App\Repositories\Address\AddressRepositoryInterface;
use App\Models\Address;

class AddressRepository implements AddressRepositoryInterface
{
    /**
     * @var Address
     */
    protected $address;

    /**
     * AddresssRepository constructor.
     *
     * @param Address $address
     */
    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    /**
     * @param array $params
     *
     * @return mixed
     */
    public function create(array $params)
    {
        return $this->address
                    ->query()
                    ->create($params);
    }

    /**
     * @param Address $address
     * @param array $params
     *
     * @return bool|int
     */
    public function update(Address $address, array $params)
    {
        return $this->address
            ->query()
            ->find($address->id)
            ->update($params);
    }
}
