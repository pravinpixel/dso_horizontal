<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackOutlifeHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_outlife_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('batch_id');
            $table->string('type');
            $table->string('item_description');
            $table->string('batch_serial');
            $table->string('last_accessed');
            $table->string('unit_packing_value');
            $table->string('quantity');
            $table->string('total_quantity');
            $table->string('withdraw_quantity');
            $table->text('remarks');
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');
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
        Schema::dropIfExists('track_outlife_histories');
    }
}
