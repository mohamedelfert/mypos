<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();

        $data['site_name_ar'] = 'لوحه التحكم';
        $data['site_name_en'] = 'My Dashboard';
        $data['logo'] = 'logo.jpg';
        $data['icon'] = 'icon.jpg';
        $data['email'] = 'info@app.com';
        $data['main_lang'] = 'arabic';
        $data['description'] = 'This Is Simple Dashboard To Start Any Project Directly';
        $data['keywords'] = 'dashboard';
        $data['status'] = 'open';
        $data['message_maintenance'] = 'Now Site In Maintenance Try Again Later';

        DB::table('settings')->insert($data);
    }
}
