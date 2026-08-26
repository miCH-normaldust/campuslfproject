<h1>Admin Dashboard</h1>
<p>Content Moderation & Activity Logs</p>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>