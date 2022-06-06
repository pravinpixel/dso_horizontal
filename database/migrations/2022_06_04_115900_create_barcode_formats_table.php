<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarcodeFormatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barcode_formats', function (Blueprint $table) {
            $table->id();
            $table->integer("batch_id")->nullable();
            $table->text("category_selection")->nullable();
            $table->text("item_description")->nullable();
            $table->text("brand")->nullable();
            $table->string("self_gen_one")->nullable();
            $table->boolean("is_self_gen_two")->default(false);
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
        Schema::dropIfExists('barcode_formats');
    }
}
