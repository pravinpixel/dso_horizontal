<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarCodeGenOnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bar_code_gen_ones', function (Blueprint $table) {
            $table->id();
            $table->integer("batch_id")->nullable();
            $table->integer("category_selection")->nullable();
            $table->text("description")->nullable();
            $table->text("brand")->nullable();
            $table->string("self_gen_one")->nullable();
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
        Schema::dropIfExists('bar_code_gen_ones');
    }
}
