<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use App\Models\ArticlePhoto;
use Database\Factories\ArticleFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Article::factory()->count(20)->create();
        Category::factory()->create(['name' => 'K-POP']);
        Category::factory()->create(['name' => 'K-Drama']);
        Category::factory()->create(['name' => 'Celebrities']);
        Category::factory()->create(['name' => 'News']);
        Category::factory()->create(['name' => 'Others']);
        Comment::factory()->count(40)->create();

        User::factory()->create([
            'name' => 'Hein Htet',
            'email' => 'heinhtet@gmail.com',
            'avatar' => 'cat.jpg'
        ]);

        User::factory()->create([
            'name' => 'Im Yoona',
            'email' => 'yoona@gmail.com',
            'avatar' => 'yoona.jpeg'
        ]);

        User::factory()->create([
            'name' => 'Jeong Dae',
            'email' => 'Jeongdae@gmail.com'
        ]);
    }

}
