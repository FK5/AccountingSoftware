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
            $table->id();
            $table->string('company_name');
            $table->string('legal_name');
            $table->foreignId('user_id')->nullable()->constrainted()->onDelete('cascade');;
            $table->string('business_id');
            $table->string('company_email');
            $table->string('company_phone_number');
            $table->string('company_address');
            $table->string('industry');
            $table->string('website')->nullable();
            $table->boolean('approved')->default(0);
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('companies');
    }
}
