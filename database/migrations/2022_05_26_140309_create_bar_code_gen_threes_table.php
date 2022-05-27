<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarCodeGenThreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bar_code_gen_threes', function (Blueprint $table) {
            $table->id();
            $table->integer("gen_two_id")->nullable();
            $table->text("repack_one")->nullable();
            $table->text("repack_two")->nullable();
            $table->string("self_gen_three")->nullable();
            $table->integer("barcode_label")->nullable();
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
        Schema::dropIfExists('bar_code_gen_threes');
    }
}
