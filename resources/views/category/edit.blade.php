<h2>Category Edit</h2>
<hr>
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

    <a href="{{route('categories.index')}}" class="btn btn-info">List</a>
    <br>
    <br>
    <form method="post" action="{{route('categories.edit', $result->id)}}">
        @csrf
        @method('PUT')
        <strong><h5>Name</h5></strong>
        <input class="form-control" placeholder="enter name" type="text" name="name" value="{{$result->name}}">
        <br>

        <strong><h5>Description</h5></strong>
        <input class="form-control mt-3" placeholder="enter name" type="text" name="description" value="{{$result   ->description}}">
        <input type="submit" class="btn btn-primary mt-3" value="edit">
    </form>
</div>


