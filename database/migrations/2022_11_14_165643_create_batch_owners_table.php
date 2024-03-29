<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_owners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('batch_id');
            $table->integer('user_id');
            $table->string('alias_name');
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
        Schema::dropIfExists('batch_owners');
    }
}
