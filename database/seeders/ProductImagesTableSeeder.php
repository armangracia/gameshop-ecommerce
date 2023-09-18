<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductImagesTableSeeder extends Seeder
{
    public function run()
    {
        $products = DB::table('products')->get();

        foreach ($products as $product) {
            // Generate random number of images for each product
            $num_images = rand(1, 5);

            for ($i = 1; $i <= $num_images; $i++) {
                // Generate a fake image filename
                $image = 'product-' . $product->id . '-image-' . $i . '.jpg';

                // Insert the image record into the database
                DB::table('product_images')->insert([
                    'product_id' => $product->id,
                    'image' => $image,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
