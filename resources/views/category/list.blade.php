<h2>Categories Management</h2>
<div class="container">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <a href="{{route('categories.create')}}" class="btn btn-success mb-3">Create</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $cat)
            <tr>
                <th scope="row">{{$cat->id}}</th>
                <td>{{$cat->name}}</td>
                <td>{{$cat->description}}</td>
                <td class="text-center">
                    <div class="text-center">
                        <a href="{{ route('categories.edit',$cat->id) }}"><button type="button" class="btn btn-primary">Edit</button></a>
                        <a href="{{ route('categories.destroy',$cat->id) }}"><button type="button" class="btn btn-danger">Delete</button></a>
                    </div>
                    
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
</div>

