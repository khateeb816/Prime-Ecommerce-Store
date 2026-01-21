<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            if (!Schema::hasColumn('categories', 'show_on_homepage')) {
                $table->boolean('show_on_homepage')->default(false);
            }
        });

        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'brand_id')) {
                $table->foreignId('brand_id')->nullable()->constrained()->onDelete('set null');
            }
            if (!Schema::hasColumn('products', 'model')) {
                $table->string('model')->nullable();
            }
            if (!Schema::hasColumn('products', 'discounted_price')) {
                 $table->decimal('discounted_price', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('products', 'stock_status')) {
                $table->string('stock_status')->default('in_stock'); // in_stock, out_of_stock
            }
            if (!Schema::hasColumn('products', 'specifications')) {
                $table->json('specifications')->nullable();
            }
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('image_path');
             $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('product_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('attribute_id')->constrained()->onDelete('cascade');
            $table->text('value');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_attribute_values');
        Schema::dropIfExists('product_images');
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropColumn(['brand_id', 'model', 'discounted_price', 'stock_status', 'specifications']);
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('show_on_homepage');
        });
    }
};
