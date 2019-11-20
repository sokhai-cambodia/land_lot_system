<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevenueCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revenue_costs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->bigIncrements('id');
            $table->integer('company_id');
            $table->integer('category_id');
            $table->dateTime('date');
            $table->double('price', 19, 2); 
            $table->mediumText('note')->nullable();
            $table->enum('type', ['revenue', 'cost']);
            $table->enum('reference_table', ['default_code', 'land_payments', 'installment_payments', 'legal_service_processes'])->default('default_code');
            $table->integer('reference_id')->nullable(); // null if reference_table = default_code 
            $table->integer('created_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revenue_costs');
    }
}
