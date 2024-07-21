<h2>Create Categoiries</h2>
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
    <form method="post" action="{{url('categories')}}">
        @csrf
        <input class="form-control" placeholder="enter name" type="text" name="name">
        <input class="form-control mt-3" placeholder="enter description" type="textarea" name="description">
        <input type="submit" class="btn btn-primary mt-3" value="create">
    </form>
</div>