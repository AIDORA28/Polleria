<?php

namespace App\Modules\Inventario\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Modules\Inventario\Models\Insumo;

class InsumoController
{
    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string'],
            'sucursal_id' => ['nullable', 'integer'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
            'sort_by' => ['nullable', 'in:id,name,sucursal_id'],
            'sort_dir' => ['nullable', 'in:asc,desc'],
            'with_trashed' => ['nullable', 'boolean'],
            'only_trashed' => ['nullable', 'boolean'],
        ]);

        $sortBy = $validated['sort_by'] ?? 'id';
        $sortDir = $validated['sort_dir'] ?? 'desc';
        $query = Insumo::query()->orderBy($sortBy, $sortDir);

        // Soft delete visibility controls
        if (!empty($validated['only_trashed'])) {
            $query->onlyTrashed();
        } elseif (!empty($validated['with_trashed'])) {
            $query->withTrashed();
        }

        if (!empty($validated['name'])) {
            $query->where('name', 'like', '%'.$validated['name'].'%');
        }
        if (array_key_exists('sucursal_id', $validated) && $validated['sucursal_id'] !== null) {
            $query->where('sucursal_id', $validated['sucursal_id']);
        }

        if (array_key_exists('per_page', $validated) && $validated['per_page'] !== null) {
            $items = $query->paginate($validated['per_page'], ['id', 'name', 'sucursal_id']);
            return new JsonResponse($items);
        }

        $items = $query->get(['id', 'name', 'sucursal_id']);
        return new JsonResponse($items);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'sucursal_id' => ['nullable', 'integer'],
        ]);

        $item = Insumo::create($data);

        return new JsonResponse($item, 201);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'sucursal_id' => ['nullable', 'integer'],
        ]);

        $item = Insumo::query()->findOrFail($id);
        $item->update($data);

        return new JsonResponse($item);
    }

    public function destroy(int $id): JsonResponse
    {
        $item = Insumo::query()->findOrFail($id);
        $item->delete();
        return new JsonResponse(['deleted' => true]);
    }

    public function restore(int $id): JsonResponse
    {
        $item = Insumo::query()->withTrashed()->findOrFail($id);
        $item->restore();
        return new JsonResponse($item);
    }
}