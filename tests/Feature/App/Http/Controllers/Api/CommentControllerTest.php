<?php

use Illuminate\Testing\Fluent\AssertableJson;

test('A user can comment on a blog post', function() {
    $this->withoutExceptionHandling();
    $user = createUser();

    $post = \App\Models\Post::factory()->create([
        'user_id' => $user->id
    ]);

    login()->postJson('api/comments/store', [
        'content' => 'This is my first comment',
        'post_id' => $post->id
    ])->assertSuccessful()
        ->assertJson(
            fn (AssertableJson $json) => $json->has('status')
                ->has('message')
                ->has('data')
        )
        ->assertJsonFragment([
            'message' => 'Comment created successfully'
        ]);
});
