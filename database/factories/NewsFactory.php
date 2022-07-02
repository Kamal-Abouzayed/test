<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => rand(1,50),
            'title' => $this->faker->name,
            'body' =>$this->faker->sentence(50),
            'image' => $this->faker->image('public/images',640,480, null, false),

        ];

    }
}
