<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PedidoControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $item = factory(Item::class)->create();

        $response = $this->post('/api/pedidos', [
            'items' => [
                'id' => $item->id,
                'quantidade' => 1
            ]
        ]);

        $response->assertStatus(200);
    }
}
