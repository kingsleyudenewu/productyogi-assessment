<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <h2>Blog Posts</h2>

    <table class="container">
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Author</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ \Str::limit($post->content, 50) }}</td>
                    <td>
                        {{ $post->user->name }}
                    </td>
                    <td>
                        <a href="{{ route('post.show', $post) }}">View</a>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $posts->links() }}
</div>
