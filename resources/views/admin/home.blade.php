<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                @guest 
                    <li><a href="{{ route('admin.register') }}">Admin Register</a></li>
                    <li><a href="{{ route('admin.login') }}">Admin Login</a></li>
                @else
                    <li>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                        <li><a href="{{ route('admin.users') }}">Manage Users</a></li>
                    </li>
                @endguest
            </ul>
        </nav>
    </header>

    <div class="container">
        @forelse ($posts as $post)
            <div class="post">
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->description }}</p>
                <img src="{{ $post->image_url }}" alt="{{ $post->title }}">

                
                <!-- Show update link if the user can update the post -->
                <a href="{{ route('admin.post.users', $post->id) }}">Show Users</a>
               
            </div>
        @empty
            <p>No posts found.</p>
        @endforelse

        {{ $posts->onEachSide(1)->links() }}
    </div>
</body>
</html>
