<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Get all category IDs
        $categoryIds = Category::pluck('id')->toArray();

        // Generate fake products
        for ($i = 1; $i <= 50; $i++) {
            $product = new Product([
                'category_id' => $faker->randomElement($categoryIds),
                'name' => $faker->words(3, true),
                'slug' => $faker->slug,
                'small_description' => $faker->sentence(10),
                'description' => $faker->paragraphs(3, true),
                'original_price' => $faker->numberBetween(100, 1000),
                'selling_price' => $faker->numberBetween(50, 900),
                'quantity' => $faker->numberBetween(10, 100),
                'trending' => $faker->boolean(20),
                'status' => $faker->boolean(80),
                'meta_title' => $faker->sentence(5),
                'meta_keyword' => $faker->words(10, true),
                'meta_description' => $faker->sentence(20),
            ]);

            $product->save();
        }
    }
}

