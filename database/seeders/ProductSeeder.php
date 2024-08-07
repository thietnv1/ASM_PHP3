<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void


    {
        Schema::disableForeignKeyConstraints();
        ProductVariant::query()->truncate();
        ProductGallery::query()->truncate();
        DB::table('product_tag')->truncate();
        Product::query()->truncate();
        ProductSize::query()->truncate();
        ProductColor::query()->truncate();
        Tag::query()->truncate();


        Tag::factory(15)->create();

        foreach (['S', 'M', 'L', 'Xl', 'XXL'] as $item) {
            ProductSize::query()->create([
                'name' => $item
            ]);
        }

        foreach (['#405D72', '#B60071', '#77E4C8', '#973131', '#E7F0DC'] as $item) {
            ProductColor::query()->create([
                'name' => $item
            ]);
        }

        for ($i = 0; $i < 50; $i++) {
            $name = fake()->text(100);
            Product::query()->create([
                'catelogure_id' => rand(2, 6),
                'name' => $name,
                'slug' => Str::slug($name) . '-' . Str::random(8),
                'sku' => Str::random(8) . $i,
                'img_thumbnail' => 'https://canifa.com/ao-phong-nu-6ts24s016q',
                'price_regular' => 600000,
                'price_sale' => 490000

            ]);
        }
        for ($i = 1; $i < 101; $i++) {
            ProductGallery::query()->insert([
                [
                    'product_id' => $i,
                    'image' => 'https://canifa.com/img/1000/1500/resize/6/o/6ot24s002-sb001-1.webp',
                ],
                [
                    'product_id' => $i,
                    'image' => 'https://canifa.com/img/1000/1500/resize/6/o/6ot24s002-sb001-l-1-u.webp',
                ],
            ]);
        }

        for( $i = 1; $i < 50; $i++) {
            DB::table('product_tag')->insert([
               ['product_id'=> $i
               ,'tag_id'=>rand(1,8)],
               ['product_id'=> $i,
               'tag_id'=>rand(9,15)],
            ]);
        }

        for ($productID = 1; $productID < 1001; $productID++) {
            $data = [];
            for ($sizeID = 1; $sizeID < 6; $sizeID++) {
                for ($colorID = 1; $colorID < 6; $colorID++) {
                    $data[] = [
                        'product_id' => $productID,
                        'product_size_id' => $sizeID,
                        'product_color_id' => $colorID,
                        'quatity' => 100,
                       'image' => 'https://canifa.com/img/1000/1500/resize/6/o/6ot24s002-sb001-l-' . $productID . '-' . $sizeID . '-' . $colorID . '.webp',
                    ];
                }
            }

            DB::table('product_variants')->insert($data);
        }
       

    }
}
