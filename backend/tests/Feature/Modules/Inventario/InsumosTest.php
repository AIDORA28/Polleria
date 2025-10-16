<?php

namespace Tests\Feature\Modules\Inventario;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Inventario\Models\Insumo;

class InsumosTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_empty_array_initially(): void
    {
        $response = $this->get('/api/v1/inventario/insumos');
        $response->assertStatus(200)->assertJson([]);
    }

    public function test_store_creates_item_and_index_returns_it(): void
    {
        $create = $this->postJson('/api/v1/inventario/insumos', [
            'name' => 'Pollo Pechuga',
            'sucursal_id' => 1,
        ]);
        $create->assertStatus(201)->assertJsonFragment(['name' => 'Pollo Pechuga']);

        $response = $this->get('/api/v1/inventario/insumos');
        $response->assertStatus(200)->assertJsonFragment(['name' => 'Pollo Pechuga']);
        $this->assertEquals(1, Insumo::query()->count());
    }

    public function test_update_modifies_item_and_delete_removes_it(): void
    {
        $create = $this->postJson('/api/v1/inventario/insumos', [
            'name' => 'Papas',
            'sucursal_id' => 2,
        ]);
        $id = $create->json('id');

        $update = $this->putJson('/api/v1/inventario/insumos/'.$id, [
            'name' => 'Papas Andinas',
            'sucursal_id' => 2,
        ]);
        $update->assertStatus(200)->assertJsonFragment(['name' => 'Papas Andinas']);

        $delete = $this->deleteJson('/api/v1/inventario/insumos/'.$id);
        $delete->assertStatus(200)->assertJson(['deleted' => true]);

        $this->assertEquals(0, Insumo::query()->count());
    }

    public function test_index_filters_by_sucursal_and_name(): void
    {
        $this->postJson('/api/v1/inventario/insumos', ['name' => 'Papas Andinas', 'sucursal_id' => 2]);
        $this->postJson('/api/v1/inventario/insumos', ['name' => 'Papas Nativas', 'sucursal_id' => 2]);
        $this->postJson('/api/v1/inventario/insumos', ['name' => 'Pollo Pechuga', 'sucursal_id' => 1]);

        $response = $this->get('/api/v1/inventario/insumos?sucursal_id=2&name=Papas');
        $response->assertStatus(200)->assertJsonFragment(['name' => 'Papas Andinas']);
        $response->assertJsonFragment(['name' => 'Papas Nativas']);
        $response->assertJsonMissing(['name' => 'Pollo Pechuga']);
    }

    public function test_index_paginates_when_per_page_provided(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            $this->postJson('/api/v1/inventario/insumos', ['name' => 'Item '.$i]);
        }

        $response = $this->get('/api/v1/inventario/insumos?per_page=2');
        $response->assertStatus(200);
        $data = $response->json('data');
        $this->assertIsArray($data);
        $this->assertCount(2, $data);
    }

    public function test_index_sorts_by_name_asc(): void
    {
        $this->postJson('/api/v1/inventario/insumos', ['name' => 'Zanahoria']);
        $this->postJson('/api/v1/inventario/insumos', ['name' => 'Aji']);

        $response = $this->get('/api/v1/inventario/insumos?sort_by=name&sort_dir=asc');
        $response->assertStatus(200);
        $items = $response->json();
        $this->assertEquals('Aji', $items[0]['name']);
        $this->assertEquals('Zanahoria', $items[1]['name']);
    }

    public function test_with_trashed_only_trashed_and_restore(): void
    {
        $a = $this->postJson('/api/v1/inventario/insumos', ['name' => 'Item A']);
        $b = $this->postJson('/api/v1/inventario/insumos', ['name' => 'Item B']);
        $idA = $a->json('id');
        $idB = $b->json('id');

        $delA = $this->deleteJson('/api/v1/inventario/insumos/'.$idA);
        $delA->assertStatus(200);

        // Sin flags: sólo activos
        $listActive = $this->get('/api/v1/inventario/insumos');
        $listActive->assertStatus(200);
        $activeItems = $listActive->json();
        $this->assertCount(1, $activeItems);
        $this->assertEquals($idB, $activeItems[0]['id']);

        // with_trashed: activos + eliminados
        $listWith = $this->get('/api/v1/inventario/insumos?with_trashed=1');
        $listWith->assertStatus(200);
        $withItems = $listWith->json();
        $this->assertCount(2, $withItems);

        // only_trashed: sólo eliminados
        $listOnly = $this->get('/api/v1/inventario/insumos?only_trashed=1');
        $listOnly->assertStatus(200);
        $onlyItems = $listOnly->json();
        $this->assertCount(1, $onlyItems);
        $this->assertEquals($idA, $onlyItems[0]['id']);

        // Restore del eliminado
        $restore = $this->postJson('/api/v1/inventario/insumos/'.$idA.'/restore');
        $restore->assertStatus(200)->assertJsonFragment(['id' => $idA]);

        // Ahora ambos activos
        $listActive2 = $this->get('/api/v1/inventario/insumos');
        $listActive2->assertStatus(200);
        $activeItems2 = $listActive2->json();
        $this->assertCount(2, $activeItems2);
    }
}