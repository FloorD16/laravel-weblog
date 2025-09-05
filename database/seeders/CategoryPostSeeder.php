<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;

class CategoryPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();
        $categories = Category::all();

        foreach ($posts as $post) {
            $post->categories()->attach(
                $categories->random(rand(1,3))->pluck('id')->toArray()
            );
        }
    }
}
