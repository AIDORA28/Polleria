<?php

namespace App\Modules\Mesas\Http\Controllers;

use Illuminate\Http\JsonResponse;

class HealthController
{
    public function index(): JsonResponse
    {
        return new JsonResponse(['status' => 'ok']);
    }
}