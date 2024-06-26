<?php

namespace Database\Factories;

use App\Enums\MediaTypes;
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
    public function definition(): array
    {
        return [
            'title' => fake()->title() ,
            'description' => fake()->paragraph(5) ,
            'media_url' => 'http://127.0.0.1:8000/download.jpeg' ,
            'media_type' => MediaTypes::IMAGE ,
        ];
    }
}
