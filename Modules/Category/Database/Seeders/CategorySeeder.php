<?php

namespace Modules\Category\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => $name1 = fake()->word(),
                'slug' => Str::slug($name1),
            ],
            [
                'name' => $name2 = fake()->word(),
                'slug' => Str::slug($name2),
            ],
        ]);
    }
}
