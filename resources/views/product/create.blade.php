<h2>Create Product</h2>

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
    <a href="{{route('products.index')}}" class="btn btn-info">List</a>
    <br>
    <br>
    <form method="post" action="{{url('products')}}" enctype="multipart/form-data">
        @csrf
        <input class="form-control" placeholder="enter name" type="text" name="name" value="{{ old('name') }}">
        <input class="form-control mt-3 bt-3" placeholder="enter price" type="number" name="price" value="{{ old('price') }}">
        <select name="category_id" class="form-control mt-3" >
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id')==$category->id)>
                {{ $category->name }}
            </option>
            @endforeach
        </select>
        <input class="form-control mt-3" type="file" name="image">
        @if ($errors->has('image'))
        <p class="text-danger"> {{$errors->first('image')}}</p>
        @endif
        <textarea class="form-control mt-3" placeholder="enter description" name="description">{{ old('description') }}</textarea>
        <input type="submit" class="btn btn-primary mt-3" value="create">
    </form>
</div>
