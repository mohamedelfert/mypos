<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            'منتج 1' => 'Product 1',
            'منتج 2' => 'Product 2',
            'منتج 3' => 'Product 3',
        ];


        foreach ($products as $key => $value) {
            Product::create([
                'category_id' => 1,
                'ar' => ['name' => $key, 'description' => 'وصف ' . $key],
                'en' => ['name' => $value, 'description' => $value . ' description'],
                'purchase_price' => 125,
                'sale_price' => 200,
                'stock' => 30,
            ]);
        }
    }
}
