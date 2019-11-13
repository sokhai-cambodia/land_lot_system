<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->bigIncrements('id');
            $table->string('name', 100)->uniqid()->index();
            $table->string('slug', 150)->uniqid()->index();
            $table->string('logo')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('address');
            $table->date('found_at');
            $table->enum('status', ['review', 'active', 'inactive'])->default('review');
            $table->integer('requested_created_by')->nullable(); // Person who request to create company
            $table->integer('created_by'); // create company by admin from cms
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
        Schema::dropIfExists('companies');
    }
}
