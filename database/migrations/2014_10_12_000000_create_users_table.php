<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
           
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->bigIncrements('id');
            $table->integer('company_id');
            $table->string('last_name', 100)->index();
            $table->string('first_name', 100)->index();
            $table->string('phone', 50)->nullable();
            $table->string('national_id', 20)->nullable();
            $table->string('passport_id', 20)->nullable();
            $table->string('image')->nullable();
            $table->string('username', 50)->nullable()->unique()->index();
            $table->string('password')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->enum('role', ['owner', 'customer', 'witness', 'staff']);
            $table->date('dob');
            $table->integer('role_id')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
