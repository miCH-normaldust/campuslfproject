<h1>Guest Dashboard - Active CampusLF Posts</h1>
<a href="{{ route('login') }}">Login</a> | <a href="{{ route('register') }}">Register</a>
<hr>
@foreach($posts as $post)
    <div>
        <h3>{{ $post->title }}</h3>
        <p>{{ $post->description }}</p>
    </div>
@endforeach