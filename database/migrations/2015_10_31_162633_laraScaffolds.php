<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LaraScaffolds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lara_scaffolds',function (Blueprint $table){
        $table->increments('id');
        $table->String('migration');
        $table->String('model');
        $table->String('controller');
        $table->String('views');
        $table->String('tablename');
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
        Schema::drop('lara_scaffolds');
    }
}
