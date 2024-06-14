<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                @guest <!-- Show register and login links for guests -->
                    <li><a href="{{ route('user.register') }}">Register</a></li>
                    <li><a href="{{ route('user.login') }}">Login</a></li>
                @else <!-- Show logout link for authenticated users -->
                    <li>
                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                    @can('create', App\Models\Post::class)
                        <!-- Show create post link if the user can create posts -->
                        <li><a href="{{ route('user.posts.create') }}">Create Post</a></li>
                    @endcan
                @endguest
            </ul>
        </nav>
    </header>

    <div class="container">
        @forelse ($posts as $post)
            <div class="post">
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->description }}</p>
                <img src="{{ $post->media_url }}" alt="{{ $post->title }}">
                @can('update', $post)
                    <!-- Show update link if the user can update the post -->
                    <a href="{{ route('user.posts.edit', $post->id) }}">Update</a>
                @endcan
                @can('view', $post)
                    <!-- Show update link if the user can view the post -->
                    <a href="{{ route('user.posts.show', $post->id) }}">Show</a>
                @endcan
                @can('delete', $post)
                    <!-- Show delete link if the user can delete the post -->
                    <form action="{{ route('user.posts.delete', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                @endcan
            </div>
        @empty
            <p>No posts found.</p>
        @endforelse

        {{ $posts->onEachSide(1)->links() }}
    </div>
</body>
</html>
