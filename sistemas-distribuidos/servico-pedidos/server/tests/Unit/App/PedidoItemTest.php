<?php

namespace Tests\Unit\App;

use App\Item;
use App\PedidoItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PedidoItemTest extends TestCase
{
    //use RefreshDatabase;
    /**
     * A basic unit test example.
     * @dataProvider itemProvider()
     * @return void
     */
    public function testIfCanAssignItem($preco, $quantidade)
    {
        $item = factory(Item::class)->make(['preco' => $preco]);

        $pedidoItem = factory(PedidoItem::class)->make();
        $pedidoItem->setItem($item, $quantidade);

        $this->assertEquals($item, $pedidoItem->item);
        $this->assertEquals($quantidade, $pedidoItem->quantidade);
        $this->assertEquals($preco, $pedidoItem->preco);
    }

    /**
     * @dataProvider itemProvider
     */
    public function testVerifySubtotal($preco, $quantidade, $expected)
    {
        $item = factory(Item::class)->make(['preco' => $preco]);

        $pedidoItem = factory(PedidoItem::class)->make();
        $pedidoItem->setItem($item, $quantidade);

        $this->assertEquals($expected, $pedidoItem->getSubtotal());
    }

    public function testGetNome()
    {
        $item = factory(Item::class)->make();

        $pedidoItem = factory(PedidoItem::class)->make();
        $pedidoItem->setItem($item, 1);

        $this->assertEquals($item->descricao, $pedidoItem->getDescricao());
    }

    public function testGetDescricao()
    {
        $item = factory(Item::class)->make();

        $pedidoItem = factory(PedidoItem::class)->make();
        $pedidoItem->setItem($item, 1);

        $this->assertEquals($item->nome, $pedidoItem->getNome());
    }
    /**
     * @return array
     */
    public function itemProvider()
    {
        return [
            [5.10, 3, 15.3],
            [2.00, 1, 2.00],
            [7.50, 2, 15.00],
            [5.99, 2, 11.98]
        ];
    }
}
