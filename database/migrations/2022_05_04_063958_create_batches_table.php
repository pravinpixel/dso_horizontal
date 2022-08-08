<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->integer('is_draft')->nullable()->default(1);
            $table->integer('material_product_id');
            $table->string('brand')->nullable();
            $table->string('barcode_number')->nullable();
            $table->string('supplier')->nullable();
            $table->integer('unit_packing_value')->nullable();
            $table->decimal('quantity',10,2)->nullable();
            $table->string('batch')->nullable();
            $table->string('serial')->nullable();
            $table->string('po_number')->nullable();
            $table->string('statutory_body')->nullable();
            $table->string('euc_material')->nullable();
            $table->string('require_bulk_volume_tracking')->nullable();
            $table->string('require_outlife_tracking')->nullable();
            $table->string('outlife')->nullable();
            $table->string('storage_area')->nullable();
            $table->string('housing_type')->nullable();
            $table->string('housing')->nullable();
            $table->string('owner_one')->nullable();
            $table->string('owner_two')->nullable();
            $table->string('department')->nullable();
            $table->string('access')->nullable();
            $table->string('date_in')->nullable();
            $table->string('date_of_expiry')->nullable();
            $table->text('coc_coa_mill_cert')->nullable();
            $table->string('coc_coa_mill_cert_status')->nullable()->default('off');
            $table->string('iqc_status')->nullable();
            $table->string('iqc_result')->nullable();
            $table->string('iqc_result_status')->nullable()->default('off');
            $table->string('sds')->nullable();
            $table->string('cas')->nullable();
            $table->string('fm_1202')->nullable();
            $table->string('project_name')->nullable();
            $table->string('material_product_type')->nullable();
            $table->string('date_of_manufacture')->nullable();
            $table->string('date_of_shipment')->nullable();
            $table->string('cost_per_unit')->nullable();
            $table->text('remarks')->nullable();
            $table->string('extended_expiry')->nullable();
            $table->string('extended_qc_status')->nullable();
            $table->string('extended_qc_result')->nullable();
            $table->string('disposal_certificate')->nullable();
            $table->string('used_for_td_expt_only')->nullable(); 
            $table->longText('repack_size')->nullable();
            $table->integer('end_of_batch')->nullable()->default(0);
            $table->string('withdrawal_type')->nullable();
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
        Schema::dropIfExists('batches');
    }
}
