<?php

use Illuminate\Testing\Fluent\AssertableJson;

test('A user can post a new blog post', function() {
   login()->postJson('api/posts/store', [
       'title' => 'My First Blog Post',
       'content' => 'This is my first blog post content'
   ])->assertSuccessful()
       ->assertJson(
           fn (AssertableJson $json) => $json->has('status')
               ->has('message', 'Post created successfully')
               ->has('data', fn ($json) => $json->has('post'))
       )
       ->assertJsonFragment([
           'message' => 'Post created successfully'
       ]);
});

test('A user can view all blog post', function () {
    login()->getJson('api/posts')
        ->assertSuccessful()
        ->assertJson(
            fn (AssertableJson $json) => $json->has('status')
                ->has('message', 'Posts retrieved successfully')
                ->has('data')
        );
});
