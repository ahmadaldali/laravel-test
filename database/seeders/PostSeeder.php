<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'uuid' => '9967f302-8bf6-11ec-91c4-4e8ee0b7post',
            'title' => 'Title Post1',
            'slug' => 'Slug Post1',
            'content' => 'Random Content',
            'metadata' => [
                "author" => "Author1",
                "image" => ""
            ]
        ]);
    }
}