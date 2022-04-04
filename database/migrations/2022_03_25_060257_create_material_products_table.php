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
            $table->integer('barcode_number')->nullable();


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
            $table->string('usage_tracking')->nullable();
            $table->string('outlife_tracking')->nullable();
            
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


            $table->string('cas')->nullable();
            $table->string('fm_1202')->nullable();
            $table->string('project_name')->nullable();
            $table->string('project_type')->nullable();
            $table->string('extended_expiry')->nullable();
            $table->string('extended_qc_status')->nullable();
            $table->string('extended_qc_result')->nullable();
            $table->string('upload_disposal_certificate')->nullable();
            $table->string('alert_threshold_qty_for_new')->nullable();
            $table->string('alert_before_expiry')->nullable();
            $table->string('date_of_manufacture')->nullable();
            $table->string('date_of_shipment')->nullable();
            $table->string('cost_per_unit')->nullable();
            $table->string('remarks')->nullable();
            
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
        Schema::dropIfExists('material_products');
    }
}
