<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewDeductTrackUsagesCols extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deduct_track_usages', function (Blueprint $table) {
            $table->string('brand');
            $table->string('unit_packing_value');
            $table->string('storage_area');
            $table->string('housing');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deduct_track_usages', function (Blueprint $table) {
            //
        });
    }
}
