<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use App\Models\Category;


// Seed 5000 Post for test

class PostSeeder extends Seeder
{
    public function run(): void
    {
        Post::factory(5000)->create();
    }
}
