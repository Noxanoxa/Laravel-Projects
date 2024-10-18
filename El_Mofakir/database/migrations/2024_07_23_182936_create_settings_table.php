<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('display_name');
            $table->string('display_name_en');
            $table->string('key');
            $table->string('value')->nullable();
            $table->string('details')->nullable();
            $table->string('type');
            $table->string('section_en');
            $table->string('section');
            $table->string('lang')->default('en');
            $table->string('ordering');
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
