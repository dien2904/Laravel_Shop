<h2>Edit User</h2>
<div class="container">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
        {{$error}}
    </div>
    <br />
    @endforeach

    <a href="{{route('auth.user')}}" class="btn btn-info">List</a>
    <h3>User Edit</h3>
    <form method="post" action="{{route('user.update', $result->id)}}">
        @csrf
        @method('PUT')
        
        <strong><h5>Name</h5></strong>
        <input class="form-control" placeholder="enter name" type="text" name="name" value="{{$result->name}}">
        <br>
        <strong><h5>Email</h5></strong>
        <input class="form-control mt-3" placeholder="enter email" type="text" name="email" value="{{$result->email}}">
        <br>
        <strong><h5>Role</h5></strong>
        <input class="form-control mt-3" placeholder="enter role" type="text" name="role" value="{{$result->role}}">
        
        
        <input type="submit" class="btn btn-primary mt-3" value="edit">
    </form>
</div>


