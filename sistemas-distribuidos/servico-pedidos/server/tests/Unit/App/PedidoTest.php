<?php

namespace Tests\Unit\App;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Pedido;
use App\PedidoItem;
use App\Item;

class PedidoTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @return void
     */
    public function testCanAddPedidoItem()
    {
        $item = factory(Item::class)->create();
        $pedido = factory(Pedido::class)->create();
        $pedido->addItem($item, 1);

        $this->assertCount(1,$pedido->items->all());
    }

    /**
     * @dataProvider dataProvider
     */
    public function testVerifyGetTotal($data, $expect)
    {
        $pedido = factory(Pedido::class)->create();

        foreach ($data as $value) {
            $item = factory(Item::class)->create(['preco' => $value['preco']]);
            $pedido->addItem($item, $value['quantidade']);
        }

        $this->assertEquals($expect, $pedido->getTotal());
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGetMutatorTotal($data)
    {
        $pedido = factory(Pedido::class)->create();

        foreach ($data as $value) {
            $item = factory(Item::class)->create(['preco' => $value['preco']]);
            $pedido->addItem($item, $value['quantidade']);
        }

        $this->assertEquals($pedido->getTotal(), $pedido->total);
    }

    public function dataProvider()
    {
        $data =  [
            [
                'preco' => 5.99,
                'quantidade' => 3
            ],
            [
                'preco' => 3.5,
                'quantidade' => 2
            ],
            [
                'preco' => 7.58,
                'quantidade' => 1
            ]
        ];

        return [
            [$data, 32.55]
        ];
    }
}
