<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $appends = ['total'];

    public function items()
    {
        return $this->hasMany(PedidoItem::class);
    }

    public function addItem(Item $item, $quantidade)
    {
        $pedidoItem = new PedidoItem();
        $pedidoItem->setItem($item, $quantidade);

        $this->items()->save($pedidoItem);
    }

    public function getTotalAttribute($value)
    {
        return $this->getTotal();
    }

    public function getTotal()
    {
        $total = 0.0;
        foreach($this->items as $item){
            $total += $item->getSubtotal();
        }
        return $total;
    }
}
