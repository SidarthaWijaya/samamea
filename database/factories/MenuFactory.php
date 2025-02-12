<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class MenuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Menu::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'price'=> $this->faker->numberBetween(5000,50000 ),
            'description'=> $this->faker->paragraph($nbSentences = 2, $variableNbSentences = true),
            'image'=> '/storage/image/makanan.jpg'
        ];
    }

 
    
}
