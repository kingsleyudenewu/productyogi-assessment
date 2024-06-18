<?php

use Illuminate\Testing\Fluent\AssertableJson;

test('A user can post a new blog post', function() {
   login()->postJson('api/posts/store', [
       'title' => 'My First Blog Post',
       'content' => 'This is my first blog post content'
   ])->assertSuccessful()
       ->assertJson(
           fn (AssertableJson $json) => $json->has('status')
               ->has('message')
               ->has('data')
       )
       ->assertJsonFragment([
           'message' => 'Post created successfully'
       ]);
});

test('A user can view all blog post', function () {
    $user = createUser();

    \App\Models\Post::factory()->create([
        'user_id' => $user->id
    ]);

    login()->getJson('api/posts')
        ->assertSuccessful()
        ->assertJson(
            fn (AssertableJson $json) => $json->has('status')
                ->where('status', 'success')
                ->has('message')
                ->where('message', 'Posts fetched successfully.')
                ->has('data')
                ->has('meta')
                ->has('links')
        )
        ->assertJsonFragment([
            'message' => 'Posts fetched successfully.'
        ]);
});

test('A user can view a single blog post', function () {
    $user = createUser();

    $post = \App\Models\Post::factory()->create([
        'user_id' => $user->id
    ]);

    login()->getJson("api/posts/{$post->id}")
        ->assertSuccessful()
        ->assertJson(
            fn (AssertableJson $json) => $json->has('status')
                ->has('message')
                ->where('message', 'Post fetched successfully.')
                ->has('data')
        );
});
