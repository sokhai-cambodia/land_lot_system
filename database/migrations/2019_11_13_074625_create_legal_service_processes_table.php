<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegalServiceProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legal_service_processes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            
            $table->bigIncrements('id');
            $table->integer('legal_service_id');
            $table->integer('user_id'); // person who respone do this service
            $table->double('fee', 19, 2);
            $table->dateTime('start_date');
            $table->dateTime('finished_date');
            $table->tinyInteger('is_continue')->default(1); // track this service need to process more or not
            $table->mediumText('note')->nullable();
            $table->enum('status', ['done', 'on_process'])->default('on_process');
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
        Schema::dropIfExists('legal_service_processes');
    }
}
