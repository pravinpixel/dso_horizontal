<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaveMySearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('save_my_searches', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('search_title');
            $table->string('batch');
            $table->string('cas');
            $table->string('date_of_expiry');
            $table->string('date_of_manufacture');
            $table->string('date_of_shipment');
            $table->string('disposed');
            $table->string('euc_material');
            $table->string('extended_expiry');
            $table->string('extended_qc_status');
            $table->string('housing_number');
            $table->string('housing_type');
            $table->string('iqc_status');
            $table->string('logsheet_id');
            $table->string('po_number');
            $table->string('product_type');
            $table->string('project_name');
            $table->string('serial');
            $table->string('statutory_board');
            $table->string('supplier');
            $table->string('unit_pkt_size');
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
        Schema::dropIfExists('save_my_searches');
    }
}
