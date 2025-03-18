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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('fr_title')->unique();
            $table->string('en_title')->unique();
            $table->string('fr_slug');
            $table->string('en_slug');
            $table->text('fr_description');
            $table->text('en_description');
            $table->string('company');
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->string('status');
            $table->string('size');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
