<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('customer')->nullable();
            $table->string('email')->nullable();
            $table->string('domisili')->nullable();
            $table->string('phone')->nullable();
            $table->date('customer_since')->nullable();
            $table->string('brand')->nullable();
            $table->string('group_product')->nullable();
            $table->string('category_product')->nullable();
            $table->string('product')->nullable();
            $table->string('name_product')->nullable();
            $table->string('gender')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->decimal('qty')->nullable();
            $table->date('transaction_date')->nullable();
            $table->string('billing')->nullable();
            $table->decimal('price')->nullable();
            $table->string('name_store')->nullable();
            $table->decimal('disc')->nullable();
            $table->decimal('netto')->nullable();
            $table->string('tipe_trancation')->nullable();

            $table->date('emailed_date')->nullable();
            $table->boolean('isEmailed')->nullable();



            $table->softDeletes();






            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_transactions');
    }
};
