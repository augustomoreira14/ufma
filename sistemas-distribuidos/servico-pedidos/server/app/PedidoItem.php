<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PedidoItem extends Model
{
    public $timestamps = false;

    protected $table = 'pedido_items';

    protected $fillable = [
        'quantidade', 'preco'
    ];

    public function setItem(Item $item, $quantidade)
    {
        $this->item()->associate($item);
        $this->preco = $item->preco;
        $this->quantidade = $quantidade;
    }

    public function getNome()
    {
        return $this->item->nome;
    }

    public function getDescricao()
    {
        return $this->item->descricao;
    }

    protected function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function getSubtotal()
    {
        return $this->preco * $this->quantidade;
    }
}
