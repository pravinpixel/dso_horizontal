<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeductTrackUsagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deduct_track_usages', function (Blueprint $table) {
            $table->id();
            $table->integer('batch_id');
            $table->bigInteger('quantity');
            $table->string('barcode_number');
            $table->string('item_description');
            $table->string('batch_serial');
            $table->string('last_accessed');
            $table->decimal('used_amount',10,3);
            $table->decimal('remain_amount',10,3);
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('deduct_track_usages');
    }
}
