<?php

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Client::class, 50)->states(Client::TYPE_INDIVIDUAL)->create();
        factory(Client::class, 50)->states(Client::TYPE_LEGAL)->create();
    }
}
