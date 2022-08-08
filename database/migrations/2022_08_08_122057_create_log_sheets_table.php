<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_sheets', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->integer('user_id');
            $table->string('user_name');
            $table->string('action_type');
            $table->string('module_name');
            $table->string('module_id')->nullable();
            $table->string('agent');
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
        Schema::dropIfExists('log_sheets');
    }
}
