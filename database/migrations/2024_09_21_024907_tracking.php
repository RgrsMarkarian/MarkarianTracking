<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tracking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('tracking',function (Blueprint $table)
        {
            $table->id();
            $table->string('device');
            $table->string('latitud');
            $table->string('longitud');
            $table->integer('up');
            $table->integer('down');
            $table->string('signal');
            $table->integer('power');
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
        //
    }
}
