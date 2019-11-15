<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lands', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            
            $table->bigIncrements('id');
            $table->integer('company_id');
            $table->string('title');
            $table->text('description');
            $table->double('size', 19, 2); //m2
            $table->double('width', 19, 2); //m
            $table->double('height', 19, 2); //m
            $table->integer('qty');//
            $table->double('price', 19, 2); 
            $table->smallInteger('commission')->default(0); // 0 - 100 
            $table->mediumText('location');
            $table->enum('type', ['land', 'land_lot'])->default('land'); // type land can use is split land lot
            $table->tinyInteger('is_split_land_lot')->default(0); // if type land_lot is_split_land_lot = 0
            $table->integer('land_id')->default(0);
            $table->string('image')->nullable();
            $table->enum('status', ['booked', 'sold', 'on_sale'])->default('on_sale');
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
        Schema::dropIfExists('lands');
    }
}
