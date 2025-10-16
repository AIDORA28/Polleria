<?php

namespace App\Modules\Mesas\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Modules\Mesas\Models\Mesa;

class MesaController
{
    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'sucursal_id' => ['nullable', 'integer'],
            'numero' => ['nullable', 'string'],
        ]);

        $query = Mesa::query()->orderBy('id', 'desc');
        if (array_key_exists('sucursal_id', $validated) && $validated['sucursal_id'] !== null) {
            $query->where('sucursal_id', $validated['sucursal_id']);
        }
        if (!empty($validated['numero'])) {
            $query->where('numero', 'like', '%'.$validated['numero'].'%');
        }

        $items = $query->get(['id', 'sucursal_id', 'numero', 'estado']);
        return new JsonResponse($items);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'sucursal_id' => ['nullable', 'integer'],
            'numero' => ['required', 'string', 'max:50'],
        ]);

        $item = Mesa::create([
            'sucursal_id' => $data['sucursal_id'] ?? null,
            'numero' => $data['numero'],
            'estado' => 'libre',
        ]);

        return new JsonResponse($item, 201);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $data = $request->validate([
            'sucursal_id' => ['nullable', 'integer'],
            'numero' => ['nullable', 'string', 'max:50'],
        ]);

        $mesa = Mesa::query()->findOrFail($id);
        $mesa->update([
            'sucursal_id' => array_key_exists('sucursal_id', $data) ? $data['sucursal_id'] : $mesa->sucursal_id,
            'numero' => array_key_exists('numero', $data) ? $data['numero'] : $mesa->numero,
        ]);

        return new JsonResponse($mesa);
    }

    public function destroy(int $id): JsonResponse
    {
        $mesa = Mesa::query()->findOrFail($id);
        $mesa->delete();
        return new JsonResponse(['deleted' => true]);
    }

    public function ocupar(int $id): JsonResponse
    {
        $mesa = Mesa::query()->findOrFail($id);
        $mesa->estado = 'ocupada';
        $mesa->save();
        return new JsonResponse($mesa);
    }

    public function liberar(int $id): JsonResponse
    {
        $mesa = Mesa::query()->findOrFail($id);
        $mesa->estado = 'libre';
        $mesa->save();
        return new JsonResponse($mesa);
    }
}