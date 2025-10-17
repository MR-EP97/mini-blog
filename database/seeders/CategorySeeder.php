<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;


// Seed 50 category for test

class CategorySeeder extends Seeder
{
    public function run(): void
    {

        $rootCategories = Category::factory(5)->create();

        foreach ($rootCategories as $root) {

            $children = Category::factory(3)->make();
            $root->appendNode($children->shift());
            $root->children()->saveMany($children);


            foreach ($root->children as $child) {
                $child->children()->saveMany(Category::factory(2)->make());
            }
        }

    }
}
