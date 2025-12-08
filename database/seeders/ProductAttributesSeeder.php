<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductAttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert sample sizes
        $sizes = [
            ['att_type' => 'Size', 'name' => 'Small', 'color' => null],
            ['att_type' => 'Size', 'name' => 'Medium', 'color' => null],
            ['att_type' => 'Size', 'name' => 'Large', 'color' => null],
            ['att_type' => 'Size', 'name' => 'XL', 'color' => null],
            ['att_type' => 'Size', 'name' => 'XXL', 'color' => null],
        ];

        // Insert sample colors
        $colors = [
            ['att_type' => 'Color', 'name' => 'Red', 'color' => '#FF0000'],
            ['att_type' => 'Color', 'name' => 'Blue', 'color' => '#0000FF'],
            ['att_type' => 'Color', 'name' => 'Green', 'color' => '#00FF00'],
            ['att_type' => 'Color', 'name' => 'Black', 'color' => '#000000'],
            ['att_type' => 'Color', 'name' => 'White', 'color' => '#FFFFFF'],
        ];

        // Merge sizes and colors
        $attributes = array_merge($sizes, $colors);

        // Insert attributes into the database
        foreach ($attributes as $attribute) {
            // Check if attribute already exists
            $exists = DB::table('attributes')
                ->where('att_type', $attribute['att_type'])
                ->where('name', $attribute['name'])
                ->first();

            if (!$exists) {
                DB::table('attributes')->insert($attribute);
            }
        }
    }
}