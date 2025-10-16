<?php

namespace Tests\Feature\Modules\Mesas;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Mesas\Models\Mesa;

class MesasTest extends TestCase
{
    use RefreshDatabase;

    public function test_health_endpoint_returns_ok(): void
    {
        $response = $this->get('/api/v1/mesas/health');
        $response->assertStatus(200)->assertJson(['status' => 'ok']);
    }

    public function test_index_returns_empty_array_initially(): void
    {
        $response = $this->get('/api/v1/mesas');
        $response->assertStatus(200)->assertJson([]);
    }

    public function test_store_creates_mesa_and_index_returns_it(): void
    {
        $create = $this->postJson('/api/v1/mesas', [
            'sucursal_id' => 1,
            'numero' => 'A1',
        ]);
        $create->assertStatus(201)->assertJsonFragment(['numero' => 'A1']);

        $response = $this->get('/api/v1/mesas');
        $response->assertStatus(200)->assertJsonFragment(['numero' => 'A1']);
        $this->assertEquals(1, Mesa::query()->count());
    }

    public function test_update_modifies_mesa_and_delete_removes_it(): void
    {
        $create = $this->postJson('/api/v1/mesas', [
            'sucursal_id' => 1,
            'numero' => 'B1',
        ]);
        $id = $create->json('id');

        $update = $this->putJson('/api/v1/mesas/'.$id, [
            'numero' => 'B2',
        ]);
        $update->assertStatus(200)->assertJsonFragment(['numero' => 'B2']);

        $delete = $this->deleteJson('/api/v1/mesas/'.$id);
        $delete->assertStatus(200)->assertJson(['deleted' => true]);

        $this->assertEquals(0, Mesa::query()->count());
    }

    public function test_ocupar_and_liberar_change_estado(): void
    {
        $create = $this->postJson('/api/v1/mesas', [
            'sucursal_id' => 1,
            'numero' => 'C1',
        ]);
        $create->assertStatus(201);
        $id = $create->json('id');

        $this->assertEquals('libre', Mesa::query()->find($id)->estado);

        $ocupar = $this->patchJson('/api/v1/mesas/'.$id.'/ocupar');
        $ocupar->assertStatus(200)->assertJsonFragment(['estado' => 'ocupada']);
        $this->assertEquals('ocupada', Mesa::query()->find($id)->estado);

        $liberar = $this->patchJson('/api/v1/mesas/'.$id.'/liberar');
        $liberar->assertStatus(200)->assertJsonFragment(['estado' => 'libre']);
        $this->assertEquals('libre', Mesa::query()->find($id)->estado);
    }
}