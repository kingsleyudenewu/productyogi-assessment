<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="flex flex-col text-lg mb-4">
        Title: {{ $post->title }} <br>
    </div>

    <div class="flex flex-col text-lg mb-4">
        Author: {{ $post->user->name }} <br>
    </div>
    <div class="flex flex-col text-lg mb-4">
        Content: {{ $post->content }} <br>
    </div>

    <div class="flex flex-col text-lg mb-4">
        Comments:
        <ul class="list-disc list-inside">
            @foreach ($post->comments as $comment)
                <li>{{ $comment->content }}</li>
            @endforeach
        </ul>
    </div>
</div>
