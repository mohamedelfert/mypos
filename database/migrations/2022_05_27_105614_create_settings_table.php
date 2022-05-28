<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name_ar');
            $table->string('site_name_en');
            $table->string('logo')->default('logo.jpg');
            $table->string('icon')->default('icon.jpg');
            $table->string('email')->default('info@app.com');
            $table->string('main_lang')->default('arabic');
            $table->longtext('description')->nullable();
            $table->longtext('keywords')->nullable();
            $table->enum('status', ['open', 'close'])->default('open');
            $table->longtext('message_maintenance')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
