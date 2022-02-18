<?php

namespace Tests\Unit;

use App\Models\Post;
use Tests\TestCase;
use Illuminate\Support\Str;

class GetPostsTest extends TestCase
{
    public function test_get_posts()
    {
        $this->json('GET', '/api/v1/main/blog')
            ->assertStatus(200)
            ->assertSee('data');
    }

    public function test_get_post()
    {
        $post = new Post();
        $post->uuid = Str::uuid()->toString();
        $post->title = 'Title Testing/test_get_post';
        $post->slug = 'Slug Testing/test_get_post';
        $post->content = 'Content Testing/test_get_post';
        $post->metadata = [];
        $post->save();

        $response = $this->json('GET', '/api/v1/main/blog/' . $post->uuid)
            ->assertStatus(200)
            ->assertSee('message')
            ->decodeResponseJson()['message'];

        $this->assertEquals($post->uuid, $response['uuid']);
        $this->assertEquals($post->title, $response['title']);
        $this->assertEquals($post->slug, $response['slug']);
        $this->assertEquals($post->content, $response['content']);
    }
}