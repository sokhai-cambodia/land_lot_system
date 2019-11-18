<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installment_payments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->bigIncrements('id');
            $table->integer('company_id');
            $table->integer('land_payment_id');
            $table->mediumText('note')->nullable();
            $table->date('installment_date'); //track schedule that customer should pay us
            $table->dateTime('paid_date')->nullable(); // date customer paid us
            $table->integer('receiver_id')->nullable(); // track who receive money from customer
            $table->double('price', 19, 2);
            $table->double('receive', 19, 2)->default(0);
            $table->enum('type', ['weekly', 'monthly', 'complete_paid'])->default('monthly'); // complete_paid use when you paid all money
            $table->enum('status', ['paid', 'unpaid'])->default('unpaid');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
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
        Schema::dropIfExists('installment_payments');
    }
}
