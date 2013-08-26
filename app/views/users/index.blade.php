<h1>Users</h1>

<ul>
  @foreach ($users as $user)
    <li><a href="{{ URL::route('users.show', array($user->slug)) }}">{{ $user->name }}</a></li>
  @endforeach
</ul>