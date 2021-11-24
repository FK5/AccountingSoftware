<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_product', function (Blueprint $table) {
            $table->primary(['invoice_id', 'product_id']);
            $table->foreignId('invoice_id')->constrainted();
            $table->foreignId('product_id')->constrainted();
            $table->integer('quantity');
            // ----------------------------------------------------
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');;
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');;
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
        Schema::dropIfExists('invoices_products');
    }
}
