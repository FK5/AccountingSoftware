<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_user', function (Blueprint $table) {
            $table->primary(['user_id', 'company_id']);
            $table->foreignId('user_id')->constrainted()->onDelete('cascade');
            $table->foreignId('company_id')->constrainted()->onDelete('cascade');
            // ----------------------------------------------------
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('companies');
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
        Schema::table('WebMasterOfficer', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['company_id']);
            $table->dropColumn('user_id');
            $table->dropColumn('company_id');
        });
    }
}
