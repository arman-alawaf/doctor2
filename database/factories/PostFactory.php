<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $title = fake()->sentence(6);
        
        return [
            'doctor_id' => Doctor::inRandomOrder()->first()?->id ?? Doctor::factory(),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . time() . '-' . fake()->unique()->numberBetween(1000, 9999),
            'description' => fake()->paragraphs(4, true),
            'image' => 'https://images.unsplash.com/photo-' . fake()->numberBetween(1500000000000, 1600000000000) . '?w=800',
            'status' => fake()->randomElement(['published', 'published', 'published', 'draft']), // Mostly published
            'views' => fake()->numberBetween(0, 1000),
        ];
    }

    /**
     * Indicate that the post is published.
     */
    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'published',
        ]);
    }

    /**
     * Indicate that the post is draft.
     */
    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'draft',
        ]);
    }
}
