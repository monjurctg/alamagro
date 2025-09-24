<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // monthly / plant-based
            $table->string('title');
            $table->string('subtitle')->nullable(); // e.g. মাসে ২ বার or ৩০-৪০ টি গাছ
            $table->integer('price');
            $table->string('frequency')->nullable(); // মাসে X বার
            $table->string('duration')->nullable(); // e.g. ১.৫ - ২ ঘন্টা
            $table->json('features'); // store features as JSON
            $table->boolean('status')->default(1);
            $table->boolean('is_popular')->default(false);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
