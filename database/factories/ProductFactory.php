<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $name = $this->faker->sentence(2);
        $subcategory = SubCategory::all()->random();
        $category = $subcategory->category;
        $brands = $category->brands->random();

        // si el valor color es verdadero
        if($subcategory->color){
            $quantity = null;
        }else{
            $quantity = 15;
        }
        return [
            'name'=>$name,
            'slug'=>Str::slug($name),
            'description'=>$this->faker->text(),
            'price'=>$this->faker->randomElement([19.99,49.99,99.99]),
            'subcategory_id'=>$subcategory->id,
            'brand_id'=>$brands->id,
            'quantity'=>$quantity,
            'status'=>2,
        ];
    }
}
