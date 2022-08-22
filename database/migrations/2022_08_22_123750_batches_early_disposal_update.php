<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BatchesEarlyDisposalUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('batches', function (Blueprint $table) {
            $table->boolean('disposed_status')->default(false);
            $table->boolean('extended_status')->default(false); 
            $table->boolean('reconciliation_status')->default(false);
            $table->integer('system_stock')->nullable();
            $table->integer('physical_stock')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('batches', function (Blueprint $table) {
            //
        });
    }
}
