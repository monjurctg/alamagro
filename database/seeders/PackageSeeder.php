<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
{
    \App\Models\Package::create([
        'type' => 'monthly',
        'title' => 'মৌলিক প্যাকেজ',
        'subtitle' => 'মাসে ২ বার',
        'price' => 600,
        'frequency' => 'মাসে ২ বার',
        'duration' => '১.৫ - ২ ঘন্টার সেবা',
        'features' => ['গাছ ছাঁটাই', 'আগাছা পরিষ্কার', 'সার-পানি দেওয়া'],
        'is_popular' => false,
    ]);

    \App\Models\Package::create([
        'type' => 'monthly',
        'title' => 'স্ট্যান্ডার্ড প্যাকেজ',
        'subtitle' => 'মাসে ৩ বার',
        'price' => 900,
        'frequency' => 'মাসে ৩ বার',
        'duration' => '১.৫ - ২ ঘন্টার সেবা',
        'features' => ['গাছ ছাঁটাই', 'আগাছা পরিষ্কার', 'সার-পানি দেওয়া', 'মেডিসিন দেওয়া'],
        'is_popular' => true,
    ]);

    \App\Models\Package::create([
        'type' => 'monthly',
        'title' => 'প্রিমিয়াম প্যাকেজ',
        'subtitle' => 'মাসে ৪ বার',
        'price' => 1200,
        'frequency' => 'মাসে ৪ বার',
        'duration' => '১.৫ - ২ ঘন্টার সেবা',
        'features' => ['গাছ ছাঁটাই', 'আগাছা পরিষ্কার', 'সার-পানি দেওয়া', 'মেডিসিন দেওয়া', 'বিশেষ যত্ন'],
        'is_popular' => false,
    ]);
}

}
