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
            $table->integer('user_id')->nullable();;
            $table->string('search_title')->nullable();;
            $table->string('batch')->nullable();;
            $table->string('cas')->nullable();;
            $table->string('date_of_expiry')->nullable();;
            $table->string('date_of_manufacture')->nullable();;
            $table->string('date_of_shipment')->nullable();;
            $table->string('disposed')->nullable();;
            $table->string('euc_material')->nullable();;
            $table->string('extended_expiry')->nullable();;
            $table->string('extended_qc_status')->nullable();;
            $table->string('housing_number')->nullable();;
            $table->string('housing_type')->nullable();;
            $table->string('iqc_status')->nullable();;
            $table->string('logsheet_id')->nullable();;
            $table->string('po_number')->nullable();;
            $table->string('product_type')->nullable();;
            $table->string('project_name')->nullable();;
            $table->string('serial')->nullable();;
            $table->string('statutory_board')->nullable();;
            $table->string('supplier')->nullable();;
            $table->string('unit_pkt_size')->nullable();;
            $table->string('usage_tracking')->nullable();
            $table->string('outlife_tracking')->nullable();
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
