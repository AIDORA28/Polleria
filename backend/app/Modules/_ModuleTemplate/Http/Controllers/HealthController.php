<?php

namespace App\Modules\_ModuleTemplate\Http\Controllers;

use Illuminate\Http\JsonResponse;

class HealthController
{
    public function index(): JsonResponse
    {
        return new JsonResponse(['status' => 'ok']);
    }
}