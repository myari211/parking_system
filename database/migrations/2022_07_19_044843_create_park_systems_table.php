<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('park_systems', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_number');
            $table->timestamp('gate_in')->nullable();
            $table->timestamp('gate_out')->nullable();
            $table->string('unique_key');
            $table->unsignedBigInteger('price')->nullable();
            $table->unsignedBigInteger('petugas_id');
            $table->timestamps();
        });

        Schema::table('park_systems', function($table) {
            $table->foreign('petugas_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('park_systems');
    }
}
