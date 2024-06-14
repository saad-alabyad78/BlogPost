@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $post->title }}</h3>
                    @can('delete', $post)
                    <form action="{{ route('admin.post.delete', $post) }}" method="POST" class="float-right">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Post</button>
                    </form>
                    @endcan
                </div>
                <div class="card-body">
                    <p>{{ $post->content }}</p>
                    <hr>
                    <h5>Users</h5>
                    <ul class="list-group">
                        @foreach($post->users as $user) <!-- Assuming $post->users gives the attached users -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $user->name }}
                                @can('delete' , $user)
                                <form action="{{ route('admin.post.removeUser', [$post, $user]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                                @endcan
                            </li>
                        @endforeach
                    </ul>
                    @can('create', App\Models\PostUser::class)
                    <form id="add-user-form" method="POST" class="mt-3">
                        @csrf
                        <div class="input-group">
                            <select id="user-select" name="user_id" class="form-control" required>
                                @foreach(App\Models\User::all() as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Add User</button>
                            </div>
                        </div>
                    </form>
                    @endcan

                    @cannot('create' , App\Models\PostUser::class)
                    <p>You do not have permission to add users.</p>
                    @endcannot

                    <script>
                        document.getElementById('add-user-form').addEventListener('submit', function(event) {
                            event.preventDefault(); // Prevent the default form submission

                            var userId = document.getElementById('user-select').value;
                            var postId = {{ $post->id }}; // Assuming you have the post ID available in the template
                            var formActionUrl = '{{ url("/admin/post") }}/' + postId + '/addUser/' + userId;
                            
                            this.action = formActionUrl;
                            this.submit(); // Submit the form with the updated action URL
                        });
                    </script>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
