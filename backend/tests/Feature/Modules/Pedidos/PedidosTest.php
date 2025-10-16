<?php

namespace Tests\Feature\Modules\Pedidos;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Pedidos\Models\Pedido;

class PedidosTest extends TestCase
{
    use RefreshDatabase;

    public function test_health_endpoint_returns_ok(): void
    {
        $response = $this->get('/api/v1/pedidos/health');
        $response->assertStatus(200)->assertJson(['status' => 'ok']);
    }

    public function test_index_returns_empty_array_initially(): void
    {
        $response = $this->get('/api/v1/pedidos');
        $response->assertStatus(200)->assertJson([]);
    }

    public function test_store_creates_pedido_and_index_returns_it(): void
    {
        $create = $this->postJson('/api/v1/pedidos', [
            'sucursal_id' => 1,
            'mesa' => 'A1',
            'items' => [
                ['producto' => 'Pollo a la brasa', 'cantidad' => 2],
            ],
        ]);
        $create->assertStatus(201)->assertJsonFragment(['mesa' => 'A1']);

        $response = $this->get('/api/v1/pedidos');
        $response->assertStatus(200)->assertJsonFragment(['mesa' => 'A1']);
        $this->assertEquals(1, Pedido::query()->count());
    }

    public function test_update_modifies_pedido(): void
    {
        $create = $this->postJson('/api/v1/pedidos', [
            'sucursal_id' => 1,
            'mesa' => 'B2',
            'items' => [
                ['producto' => 'Inka Kola', 'cantidad' => 1],
            ],
        ]);
        $id = $create->json('id');

        $update = $this->putJson('/api/v1/pedidos/'.$id, [
            'mesa' => 'B3',
            'items' => [
                ['producto' => 'Inka Kola', 'cantidad' => 2],
            ],
        ]);
        $update->assertStatus(200)->assertJsonFragment(['mesa' => 'B3']);
    }

    public function test_cerrar_changes_estado_to_cerrado(): void
    {
        $create = $this->postJson('/api/v1/pedidos', [
            'sucursal_id' => 1,
            'mesa' => 'C1',
            'items' => [
                ['producto' => 'Chicha morada', 'cantidad' => 3],
            ],
        ]);
        $id = $create->json('id');

        $close = $this->patch('/api/v1/pedidos/'.$id.'/cerrar');
        $close->assertStatus(200)->assertJsonFragment(['estado' => 'cerrado']);

        $pedido = Pedido::query()->findOrFail($id);
        $this->assertEquals('cerrado', $pedido->estado);
    }

    public function test_update_fails_when_pedido_is_cerrado(): void
    {
        $create = $this->postJson('/api/v1/pedidos', [
            'sucursal_id' => 1,
            'mesa' => 'E1',
            'items' => [
                ['producto' => 'Agua', 'cantidad' => 1],
            ],
        ]);
        $id = $create->json('id');

        $this->patch('/api/v1/pedidos/'.$id.'/cerrar')->assertStatus(200);

        $update = $this->putJson('/api/v1/pedidos/'.$id, [
            'mesa' => 'E2',
        ]);
        $update->assertStatus(409)->assertJson(['error' => 'Pedido cerrado']);

        $pedido = Pedido::query()->findOrFail($id);
        $this->assertEquals('cerrado', $pedido->estado);
        $this->assertEquals('E1', $pedido->mesa);
    }

    public function test_index_filters_by_sucursal_estado_and_mesa(): void
    {
        // Cerrado en sucursal 2 con mesa B1: debe aparecer
        $p1 = $this->postJson('/api/v1/pedidos', [
            'sucursal_id' => 2,
            'mesa' => 'B1',
            'items' => [
                ['producto' => 'Papas', 'cantidad' => 1],
            ],
        ]);
        $id1 = $p1->json('id');
        $this->patch('/api/v1/pedidos/'.$id1.'/cerrar');

        // Abierto en sucursal 2 con mesa B2: no debe aparecer por estado
        $this->postJson('/api/v1/pedidos', [
            'sucursal_id' => 2,
            'mesa' => 'B2',
            'items' => [
                ['producto' => 'Gaseosa', 'cantidad' => 1],
            ],
        ]);

        // Cerrado en sucursal 1 con mesa C1: no debe aparecer por sucursal
        $p3 = $this->postJson('/api/v1/pedidos', [
            'sucursal_id' => 1,
            'mesa' => 'C1',
            'items' => [
                ['producto' => 'Chicha', 'cantidad' => 1],
            ],
        ]);
        $id3 = $p3->json('id');
        $this->patch('/api/v1/pedidos/'.$id3.'/cerrar');

        $response = $this->get('/api/v1/pedidos?sucursal_id=2&estado=cerrado&mesa=B');
        $response->assertStatus(200)->assertJsonFragment(['mesa' => 'B1']);
        $response->assertJsonMissing(['mesa' => 'B2']);
        $response->assertJsonMissing(['mesa' => 'C1']);
    }

    public function test_index_paginates_when_per_page_provided(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            $this->postJson('/api/v1/pedidos', [
                'sucursal_id' => 1,
                'mesa' => 'P'.$i,
                'items' => [
                    ['producto' => 'Prod'.$i, 'cantidad' => 1],
                ],
            ]);
        }

        $response = $this->get('/api/v1/pedidos?per_page=2');
        $response->assertStatus(200);
        $data = $response->json('data');
        $this->assertIsArray($data);
        $this->assertCount(2, $data);
    }

    public function test_index_sorts_by_mesa_asc(): void
    {
        $this->postJson('/api/v1/pedidos', [
            'sucursal_id' => 1,
            'mesa' => 'Z1',
            'items' => [
                ['producto' => 'Z', 'cantidad' => 1],
            ],
        ]);

        $this->postJson('/api/v1/pedidos', [
            'sucursal_id' => 1,
            'mesa' => 'A1',
            'items' => [
                ['producto' => 'A', 'cantidad' => 1],
            ],
        ]);

        $response = $this->get('/api/v1/pedidos?sort_by=mesa&sort_dir=asc');
        $response->assertStatus(200);
        $items = $response->json();
        $this->assertEquals('A1', $items[0]['mesa']);
        $this->assertEquals('Z1', $items[1]['mesa']);
    }

    public function test_delete_removes_pedido(): void
    {
        $create = $this->postJson('/api/v1/pedidos', [
            'sucursal_id' => 1,
            'mesa' => 'D1',
            'items' => [
                ['producto' => 'Papa a la huancaína', 'cantidad' => 1],
            ],
        ]);
        $id = $create->json('id');

        $delete = $this->delete('/api/v1/pedidos/'.$id);
        $delete->assertStatus(200)->assertJson(['deleted' => true]);

        $this->assertEquals(0, Pedido::query()->count());
    }

    public function test_cancelar_and_abrir_with_validations(): void
    {
        $create = $this->postJson('/api/v1/pedidos', [
            'sucursal_id' => 1,
            'mesa' => 'K1',
            'items' => [
                ['producto' => 'Cerveza', 'cantidad' => 1],
            ],
        ]);
        $id = $create->json('id');

        // No se puede abrir si está abierto
        $openFail = $this->patch('/api/v1/pedidos/'.$id.'/abrir');
        $openFail->assertStatus(409)->assertJson(['error' => 'Pedido no cerrado']);

        // Cancelar cierra (desde abierto)
        $cancel = $this->patch('/api/v1/pedidos/'.$id.'/cancelar');
        $cancel->assertStatus(200)->assertJsonFragment(['estado' => 'cerrado']);

        // No se puede cancelar si ya está cerrado
        $cancelFail = $this->patch('/api/v1/pedidos/'.$id.'/cancelar');
        $cancelFail->assertStatus(409)->assertJson(['error' => 'Pedido no abierto']);

        // Abrir reabre (desde cerrado)
        $open = $this->patch('/api/v1/pedidos/'.$id.'/abrir');
        $open->assertStatus(200)->assertJsonFragment(['estado' => 'abierto']);
    }
}