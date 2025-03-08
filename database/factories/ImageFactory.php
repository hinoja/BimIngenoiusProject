<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'https://placehold.co/600x400?text=Placeholder',
        ];
    }

    public function withProjectTitle($title)
    {
        return $this->state(function (array $attributes) use ($title) {
            return [
                'name' => 'https://placehold.co/600x400?text=' . urlencode($title),
            ];
        });
    }
}
