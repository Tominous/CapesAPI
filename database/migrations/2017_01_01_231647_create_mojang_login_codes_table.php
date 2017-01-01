<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMojangLoginCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mojang_login_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('uuid');
            $table->string('code')->unique();
            $table->boolean('used')->defaults(false);
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
        Schema::dropIfExists('mojang_login_codes');
    }
}
