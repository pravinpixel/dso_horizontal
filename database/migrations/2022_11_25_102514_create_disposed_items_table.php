<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisposedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposed_items', function (Blueprint $table) {
            $table->id();
            $table->string("TransactionDate")->nullable();
            $table->string("TransactionTime")->nullable();
            $table->string("TransactionBy")->nullable();
            $table->string("ItemDescription")->nullable();
            $table->string("BatchSerial")->nullable();
            $table->string("UnitPackingValue")->nullable();
            $table->string("Quantity")->nullable();
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
        Schema::dropIfExists('disposed_items');
    }
}
