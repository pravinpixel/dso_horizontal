<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialProductHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_product_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('batch_id');
            $table->string('barcode_number')->nullable(); 
            $table->string('CategorySelection')->nullable();
            $table->string('ItemDescription')->nullable();
            $table->string('Brand')->nullable();
            $table->string('BatchSerial')->nullable();
            $table->string('TransactionBy')->nullable();
            $table->string('Module')->nullable();
            $table->string('ActionTaken')->nullable();
            $table->string('UnitPackingValue')->nullable();
            $table->string('Quantity')->nullable();
            $table->string('StorageArea')->nullable();
            $table->string('Housing')->nullable();
            $table->longText('Owners')->nullable();
            $table->longText('Remarks')->nullable();
            $table->string('DrawStatus')->nullable();
            $table->string('RemainingOutlifeOfParent')->nullable();
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
        Schema::dropIfExists('material_product_histories');
    }
}
