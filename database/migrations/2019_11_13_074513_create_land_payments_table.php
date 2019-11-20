<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('land_payments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->bigIncrements('id');
            $table->integer('company_id');
            $table->integer('land_id');
            $table->integer('saler_id');
            $table->integer('customer_id');
            $table->integer('broker_id')->nullable();
            $table->integer('witness1_id');
            $table->integer('witness2_id')->nullable();
            $table->integer('witness3_id')->nullable();
            $table->double('price', 19, 2);
            $table->double('deposit', 19, 2)->default(0); // deposit money
            $table->dateTime('deposit_at')->nullable();
            $table->double('receive', 19, 2)->default(0); // money receive
            $table->dateTime('receive_at')->nullable();
            $table->double('discount', 19, 2)->default(0);
            $table->double('comission', 19, 2)->default(0);
            $table->enum('payment_type', ['installment_payment', 'completed_payment'])->default('installment_payment');
            $table->enum('status', ['sold', 'booked', 'installment_process', 'installment_done']); // track staus of payment 
            $table->enum('installment_type', ['weekly', 'monthly', 'none']); // which installment user want to paid weekly or monthly
            $table->integer('installment_total')->default(0); // track how many month user should pay (12 month)
            $table->integer('installment_process')->default(0); // trach how many month user paid us(3/12)month
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('land_payments');

    }
}
