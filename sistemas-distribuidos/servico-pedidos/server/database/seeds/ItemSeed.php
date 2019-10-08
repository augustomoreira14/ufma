<?php

use App\Item;
use Illuminate\Database\Seeder;

class ItemSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 10; $i++){
            factory(Item::class)->create();
        }
    }
}
