<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarCodeFormatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bar_code_formats', function (Blueprint $table) {
            $table->id();
            $table->integer("material_product_id")->nullable();
            $table->integer("batch_id")->nullable();
            $table->integer("category_selection")->nullable();
            $table->text("description")->nullable();
            $table->text("brand")->nullable();
            $table->string("self_gen_one")->nullable();
            $table->text("batch")->nullable();
            $table->text("serial")->nullable();
            $table->string("self_gen_two")->nullable();
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
        Schema::dropIfExists('bar_code_formats');
    }
}
