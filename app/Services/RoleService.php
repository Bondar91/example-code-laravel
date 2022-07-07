<?php

namespace App\Services;

use App\Repositories\Role\RoleRepository;
use Illuminate\Database\Eloquent\Collection;

class RoleService
{
    /**
     * @var $roleRepository
     */
    protected $roleRepository;

    /**
     * DiscountCouponService constructor.
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @return Collection|\Illuminate\Database\Eloquent\Builder[]
     */
    public function getRoles()
    {
        return $this->roleRepository->getAll();
    }
}
