<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->boolean('show_on_homepage')->default(false);
            $table->timestamps();
        });

        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., Color, RAM, Size
            $table->string('slug')->unique();
            $table->string('type')->default('text'); // text, select, boolean
            $table->timestamps();
        });

        Schema::create('category_attribute', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('attribute_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_attribute');
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('brands');
    }
};
