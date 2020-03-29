<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('birth');
            $table->string('id_number');
            $table->string("medical_number")->nullable();
            $table->string("sex")->nullable();
            $table->string("address")->nullable();
            $table->string('tel_home')->nullable();
            $table->string('tel_mobile')->nullable();
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
        Schema::dropIfExists('client_users');
    }
}
