<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('sliders')->insert([
                'id' => Str::uuid(),
                'name' => "Promo Banner $i",
                'slug' => "slider-$i",
                'description' => "Special promotion slider $i",
                'image' => "https://picsum.photos/800/300?random=$i",
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
