<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('product_variations')) {
            Schema::create('product_variations', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('product_id');
                $table->string('size', 191)->nullable();
                $table->string('color', 191)->nullable();
                $table->decimal('price', 10, 2)->default(0.00);
                $table->decimal('old_price', 10, 2)->nullable();
                $table->integer('stock_qty')->nullable()->default(null);
                $table->string('sku', 191)->nullable();
                $table->boolean('is_default')->default(false);
                $table->timestamps();

                $table->index('product_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variations');
    }
};
