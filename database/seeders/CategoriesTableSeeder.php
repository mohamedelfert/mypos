<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'العاب' => 'Games',
            'ملابس' => 'Clothes',
            'كتب' => 'Books',
        ];


        foreach ($categories as $key => $value) {
            Category::create([
                'ar' => ['name' => $key],
                'en' => ['name' => $value],
            ]);
        }
    }
}
