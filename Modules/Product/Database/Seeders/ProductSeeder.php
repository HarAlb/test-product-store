<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $currencyIds = DB::table('currencies')->pluck('id')->toArray();
        $categoryIds = DB::table('categories')->pluck('id')->toArray();

        if (empty($currencyIds) || empty($categoryIds)) {
            $this->command->warn('Нет данных в таблицах currencies или categories.');

            return;
        }

        // Вставляем 10 случайных продуктов
        for ($i = 0; $i < 10; $i++) {
            DB::table('products')->insert([
                'name' => $faker->words(3, true),
                'description' => $faker->sentence(10),
                'price' => $faker->randomFloat(2, 10, 500),
                'currency_id' => $faker->randomElement($currencyIds),
                'category_id' => $faker->randomElement($categoryIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
