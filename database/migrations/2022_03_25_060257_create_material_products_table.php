<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_products', function (Blueprint $table) {
            $table->id();
            $table->string('category_selection')->nullable();
            $table->string('item_description')->nullable();
            $table->integer('in_house_product_logsheet_id')->nullable();
            $table->string('brand')->nullable();
            $table->string('supplier')->nullable();
            $table->string('unit_packing_size')->nullable();
            $table->string('quantity')->nullable();
            $table->string('batch')->nullable();
            $table->string('serial')->nullable();
            $table->string('po_number')->nullable();
            $table->string('statutory_body')->nullable();
            $table->string('euc_material')->nullable();
            
            $table->string('storage_room')->nullable();
            $table->string('house_type')->nullable();
            $table->string('owner_one')->nullable();
            $table->string('owner_two')->nullable();
            $table->string('department')->nullable();
            $table->string('access')->nullable();
            $table->string('date_in')->nullable();
            $table->string('date_of_expiry')->nullable();
            $table->string('iqc_status')->nullable();
            $table->string('sds_mill_cert_document')->nullable();
            $table->string('coc_coa_mill_cert_document')->nullable();
            $table->string('iqc_result')->nullable();

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
        Schema::dropIfExists('matrial_peoducts');
    }
}
