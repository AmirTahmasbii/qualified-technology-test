<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        Item::factory()->count(50)->create()->each(function ($item) {
            $path = storage_path('app/public/sample.png');
            $item->addMedia($path)->preservingOriginal()->toMediaCollection();
        });
    }
}
