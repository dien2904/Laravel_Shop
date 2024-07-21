<h2>Product Management</h2>
<div class="container">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <a href="{{route('products.create')}}" class="btn btn-success mb-3">Create</a>
    
    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Image</th>
                <th scope="col">Description</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $prod)
            <tr>
                <th scope="row">{{$prod->id}}</th>
                <td>{{$prod->name}}</td>
                <td>{{$prod->price}}</td>
                <!-- <td><img onerror="this.src='https://placehold.co/600x400'" src="{{$prod->image}}" class="img-thumbnail" width="100px" /></td> -->
                <td>
                    <?php
                    $imageUrl = $prod->image;
                    $imageExists = false;
                    if (filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                        $headers = @get_headers($imageUrl);
                        $imageExists = $headers && strpos($headers[0], '200') !== false;
                    }
                    ?>
                    @if($imageExists)
                    <img src=" {{$prod->image}}" class="img-thumbnail" width="100px" />
                    @else
                    <img src=" {{asset('/images/'.$prod->image)}}" class="img-thumbnail" width="100px" />
                    @endif
                </td>
                <td>{{$prod->description}}</td>
                <td class="text-center">
                    <div class="text-center">
                        <a href="{{ route('product.edit',$prod->id) }}"><button type="button" class="btn btn-primary">Edit</button></a>
                        <a href="{{ route('product.destroy',$prod->id) }}"><button type="button" class="btn btn-danger">Delete</button></a>
                    </div>
                    
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
    <div class="product-pagination">
        {{$products->onEachSide(2)->links()}}
    </div>

</div>

