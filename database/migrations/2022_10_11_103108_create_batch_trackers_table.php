<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_trackers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_batch_id');
            $table->foreign('from_batch_id')->references('id')->on('batches');//->onDelete('cascade');
            $table->integer('to_batch_id');
            $table->string('action_type');
            $table->string('action_by');
            $table->string('quantity');
            $table->string('total_quantity');
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
        Schema::dropIfExists('batch_trackers');
    }
}
