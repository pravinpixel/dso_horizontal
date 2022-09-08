<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepackOutlivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repack_outlives', function (Blueprint $table) {
            $table->id();
            $table->integer('batch_id');
            $table->integer('quantity')->nullable();
            $table->boolean('draw_in')->nullable()->default(true);
            $table->boolean('draw_out')->nullable()->default(false);
            $table->string('draw_in_time_stamp')->nullable();
            $table->string('draw_out_time_stamp')->nullable();
            $table->string('draw_in_last_access')->nullable();
            $table->string('draw_out_last_access')->nullable();
            $table->integer('input_repack_amount')->nullable();
            $table->integer('remain_amount')->nullable();
            $table->string('barcode_number')->nullable();
            $table->integer('repack_size')->nullable();
            $table->string('qty_cut')->nullable();
            $table->string('remain_days')->nullable();
            $table->string('last_date_time')->nullable();
            $table->string('current_date_time')->nullable(); 
            $table->integer('remaining_days_seconds')->nullable(); 
            $table->string('updated_outlife')->nullable();
            $table->integer('updated_outlife_seconds')->nullable();
            $table->string('current_outlife_expiry')->nullable();
            $table->longText('remarks')->nullable();
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
        Schema::dropIfExists('repack_outlives');
    }
}