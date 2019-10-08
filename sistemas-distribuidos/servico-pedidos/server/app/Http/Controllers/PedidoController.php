<?php


namespace App\Http\Controllers;


use App\Item;
use App\Pedido;
use App\PedidoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PedidoController extends Controller
{
    public function store(Request $req)
    {
        try{
            $pedido = DB::transaction(function() use ($req){
                $pedido = Pedido::create();
                foreach ($req->items as $item){
                    $pedido->addItem(
                        Item::findOrFail($item['id']),
                        $item['quantidade']
                    );
                }

                return $pedido;
            });

            return response()->json($pedido);

        }catch (\Exception $ex){
            return response()->json($ex->getMessage());
        }
    }
}
