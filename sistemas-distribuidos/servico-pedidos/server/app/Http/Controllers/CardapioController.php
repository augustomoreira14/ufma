<?php


namespace App\Http\Controllers;


use App\Item;

class CardapioController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return response()->json($items);
    }
}
