<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker->addProvider(new \Mmo\Faker\PicsumProvider($this->faker));
        return [
            'titulo'=>ucfirst($this->faker->unique()->words(random_int(2,4), true)),
            'contenido'=>$this->faker->text(),
            'estado'=>random_int(1,2),
            'user_id'=>User::all()->random()->id,
            'imagen'=>'posts/'.$this->faker->picsum('public/storage/posts', 640, 480, null, false),
        ];
    }
}
