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
        Schema::create('template_emails', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('subject');
            $table->longText('body')->nullable();
            $table->string('category')->nullable();
            $table->string('name_attachment')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_emails');
    }
};
