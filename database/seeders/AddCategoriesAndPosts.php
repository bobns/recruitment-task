<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Faker\Factory;
use Illuminate\Database\Seeder;

class AddCategoriesAndPosts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Category::truncate();
        Post::truncate();

        for ($i = 0; $i < 10; $i++) {
            $category = Category::create([
                    'name' => $faker->word(),
                    'created_by_user_id' => 1
                ]);

            $post = Post::create([
                    'title' => $faker->word(),
                    'message' => $faker->text(),
                    'user_id' => 1,
                ]);

            $post->categories()->sync($category);
        }
    }
}