<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategories = [
            /* celulares y tablets */
            [
                'name' => 'Celulares y smartphones',
                'slug' => Str::slug('Celulares y smartphones'),
                'category_id' => 1,
                'color' => true
            ],

             [
                'name' => 'Accesorios para celulares',
                'slug' => Str::slug('Accesorios para celulares'),
                'category_id' => 1,
            ],

            [
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches'),
                'category_id' => 1,
            ],
            /* 'tv, audio y video', */
            [
                'name' => 'Tv y audio',
                'slug' => Str::slug('Tv y audio'),
                'category_id' => 2,
            ],
            [
                'name' => 'Audios',
                'slug' => Str::slug('Audios'),
                'category_id' => 2,
            ],
            [
                'name' => 'Audio para auto',
                'slug' => Str::slug('Audio para auto'),
                'category_id' => 2,
            ],
            /* Console y videojuego */
            [
                'name' => 'Xbox',
                'slug' => Str::slug('Xbox'),
                'category_id' => 3,
            ],
            [
                'name' => 'PlayStaion',
                'slug' => Str::slug('PlayStaion'),
                'category_id' => 3,
            ],
            [
                'name' => 'Videojuego para pc',
                'slug' => Str::slug('Videojuego para pc'),
                'category_id' => 3,
            ],
            [
                'name' => 'Nintendo',
                'slug' => Str::slug('Nintendo'),
                'category_id' => 3,
            ],
            /* Computacion */
            [
                'name' => 'Portatiles',
                'slug' => Str::slug('Portatiles'),
                'category_id' => 4,
            ],
            [
                'name' => 'Pc escritotio',
                'slug' => Str::slug('Pc escritotio'),
                'category_id' => 4,
            ],
            [
                'name' => 'Almacenamiento',
                'slug' => Str::slug('Almacenamiento'),
                'category_id' => 4,
            ],
            [
                'name' => 'Accesorio Computadora',
                'slug' => Str::slug('Accesorio Computadora'),
                'category_id' => 4,
            ],
            /* Moda */
            [
                'name' => 'Mujeres',
                'slug' => Str::slug('Mujeres'),
                'category_id' => 5,
            ],
            [
                'name' => 'Hombres',
                'slug' => Str::slug('Hombres'),
                'category_id' => 5,
                'color' => true,
                'size' => true,
            ],
            [
                'name' => 'Lentes',
                'slug' => Str::slug('Lentes'),
                'category_id' => 5,
                'color' => true,
                'size' => true,
            ],
            [
                'name' => 'Relojes',
                'slug' => Str::slug('Relojes'),
                'category_id' => 5,
            ],
        ];

        foreach ($subcategories as $subcategory) {
           SubCategory::factory(1)->create($subcategory);
        }
    }
}
