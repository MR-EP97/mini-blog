<?php

namespace Database\Factories;

use App\Enums\Post\PostStatus;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $title = $this->faker->unique()->sentence(4);

        return [
            'user_id' => User::query()->inRandomOrder()->first()->id ?? 1,
            'category_id' => Category::query()->inRandomOrder()->first()->id ?? 1,
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'content' => $this->faker->paragraphs(3, true),
            'published_at' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),
            'status' => $this->faker->randomElement([
                PostStatus::Draft->value,
                PostStatus::Published->value,
                PostStatus::Archived->value,
            ]),
        ];
    }
}
