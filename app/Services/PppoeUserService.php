<?php

namespace App\Services;

use App\Models\PppoeUser;

class PppoeUserService
{
    public function createUser($regionId, $serviceTypeId)
    {
        return PppoeUser::create([
            'region_id' => $regionId,
            'service_type_id' => $serviceTypeId,
        ]);
    }
}