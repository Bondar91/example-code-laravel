<?php

namespace App\Dhl;

/**
 * Class AuthData
 *
 * @package \App\Dhl
 */
class AuthData
{
    private function authData()
    {
        $params = [
            'username' => \Config::get('dhl.username'),
            'password' => \Config::get('dhl.password'),
        ];

        return $params;
    }

    public function getAuthData()
    {
        return $this->authData();
    }
}
