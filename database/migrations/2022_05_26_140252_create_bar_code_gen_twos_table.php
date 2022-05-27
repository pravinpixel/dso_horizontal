<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarCodeGenTwosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bar_code_gen_twos', function (Blueprint $table) {
            $table->id();
            $table->integer("gen_one_id")->nullable();
            $table->integer("batch_id")->nullable();
            $table->text("batch")->nullable();
            $table->text("serial")->nullable();
            $table->string("self_gen_two")->nullable();
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
        Schema::dropIfExists('bar_code_gen_twos');
    }
}
