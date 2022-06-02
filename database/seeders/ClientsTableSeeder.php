<?php

namespace Database\Seeders;

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
        $clients = [
            'mohamed ali' => [
                'phone' => '01165215487',
                'email' => 'mohamed@yahoo.com',
                'address' => 'cairo',
            ],
            'ahmed hosam' => [
                'phone' => '01100515487',
                'email' => 'ahmed@yahoo.com',
                'address' => 'tanta',
            ],
            'sara mohamed' => [
                'phone' => '01165260787',
                'email' => 'sara@yahoo.com',
                'address' => 'alex',
            ],
        ];


        foreach ($clients as $key => $value) {
            Client::create([
                'name' => $key,
                'phone' => $value['phone'],
                'email' => $value['email'],
                'address' => $value['address'],
            ]);
        }
    }
}
