<html>

<head>List User</head>

<body>
    
    @foreach ($users as $user)
    <p>Name: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
    <a href="#">more</a>
    <hr />
    @endforeach

</body>

</html>