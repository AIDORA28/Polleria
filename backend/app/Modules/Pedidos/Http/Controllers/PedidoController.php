<?php

namespace App\Modules\Pedidos\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Modules\Pedidos\Models\Pedido;

class PedidoController
{
    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'mesa' => ['nullable', 'string'],
            'estado' => ['nullable', 'string', 'in:abierto,cerrado'],
            'sucursal_id' => ['nullable', 'integer'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
            'sort_by' => ['nullable', 'in:id,mesa,estado,sucursal_id'],
            'sort_dir' => ['nullable', 'in:asc,desc'],
        ]);

        $sortBy = $validated['sort_by'] ?? 'id';
        $sortDir = $validated['sort_dir'] ?? 'desc';
        $query = Pedido::query()->orderBy($sortBy, $sortDir);

        if (!empty($validated['mesa'])) {
            $query->where('mesa', 'like', '%'.$validated['mesa'].'%');
        }
        if (array_key_exists('estado', $validated) && $validated['estado'] !== null) {
            $query->where('estado', $validated['estado']);
        }
        if (array_key_exists('sucursal_id', $validated) && $validated['sucursal_id'] !== null) {
            $query->where('sucursal_id', $validated['sucursal_id']);
        }

        if (array_key_exists('per_page', $validated) && $validated['per_page'] !== null) {
            $items = $query->paginate($validated['per_page'], ['id', 'sucursal_id', 'mesa', 'estado', 'items']);
            return new JsonResponse($items);
        }

        $items = $query->get(['id', 'sucursal_id', 'mesa', 'estado', 'items']);
        return new JsonResponse($items);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'sucursal_id' => ['nullable', 'integer'],
            'mesa' => ['nullable', 'string', 'max:50'],
            'items' => ['required', 'array', 'min:1'],
        ]);

        $item = Pedido::create([
            'sucursal_id' => $data['sucursal_id'] ?? null,
            'mesa' => $data['mesa'] ?? null,
            'items' => $data['items'],
            'estado' => 'abierto',
        ]);

        return new JsonResponse($item, 201);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $data = $request->validate([
            'sucursal_id' => ['nullable', 'integer'],
            'mesa' => ['nullable', 'string', 'max:50'],
            'items' => ['nullable', 'array'],
        ]);

        $pedido = Pedido::query()->findOrFail($id);
        if ($pedido->estado === 'cerrado') {
            return new JsonResponse(['error' => 'Pedido cerrado'], 409);
        }
        $pedido->update([
            'sucursal_id' => array_key_exists('sucursal_id', $data) ? $data['sucursal_id'] : $pedido->sucursal_id,
            'mesa' => array_key_exists('mesa', $data) ? $data['mesa'] : $pedido->mesa,
            'items' => array_key_exists('items', $data) ? $data['items'] : $pedido->items,
        ]);

        return new JsonResponse($pedido);
    }

    public function cerrar(int $id): JsonResponse
    {
        $pedido = Pedido::query()->findOrFail($id);
        $pedido->estado = 'cerrado';
        $pedido->save();
        return new JsonResponse($pedido);
    }

    public function abrir(int $id): JsonResponse
    {
        $pedido = Pedido::query()->findOrFail($id);
        if ($pedido->estado !== 'cerrado') {
            return new JsonResponse(['error' => 'Pedido no cerrado'], 409);
        }
        $pedido->estado = 'abierto';
        $pedido->save();
        return new JsonResponse($pedido);
    }

    public function cancelar(int $id): JsonResponse
    {
        $pedido = Pedido::query()->findOrFail($id);
        if ($pedido->estado !== 'abierto') {
            return new JsonResponse(['error' => 'Pedido no abierto'], 409);
        }
        $pedido->estado = 'cerrado';
        $pedido->save();
        return new JsonResponse($pedido);
    }

    public function destroy(int $id): JsonResponse
    {
        $pedido = Pedido::query()->findOrFail($id);
        $pedido->delete();
        return new JsonResponse(['deleted' => true]);
    }
}