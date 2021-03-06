<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_products', function (Blueprint $table) {
            $table->id();  
            $table->string('category_selection')->nullable();
            $table->string('item_description')->nullable();
            $table->string('unit_of_measure')->nullable();
            $table->string('unit_packing_value')->nullable();
            $table->string('quantity')->nullable(); 
            $table->integer('alert_threshold_qty_upper_limit')->nullable();
            $table->integer('alert_threshold_qty_lower_limit')->nullable();
            $table->integer('alert_before_expiry')->nullable(); 
            $table->softDeletes();
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
        Schema::dropIfExists('material_products');
    }
}
