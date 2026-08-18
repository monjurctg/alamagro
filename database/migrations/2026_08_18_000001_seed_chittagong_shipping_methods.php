<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('shipping')) {
            // Check if Inside Chittagong exists
            $insideExists = DB::table('shipping')->where('title', 'like', '%Chittagong%')->orWhere('title', 'like', '%চট্টগ্রাম%')->exists();
            if (!$insideExists) {
                DB::table('shipping')->insert([
                    [
                        'title' => 'Inside Chittagong (চট্টগ্রামের ভেতরে)',
                        'shipping_fee' => 80.00,
                        'desc' => 'চট্টগ্রাম সিটির মধ্যে ডেলিভারি চার্জ ৮০ টাকা',
                        'is_publish' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'title' => 'Outside Chittagong (চট্টগ্রামের বাইরে)',
                        'shipping_fee' => 150.00,
                        'desc' => 'চট্টগ্রাম সিটির বাইরে সারা বাংলাদেশে ডেলিভারি চার্জ ১৫০ টাকা',
                        'is_publish' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op to prevent accidental data deletion
    }
};
