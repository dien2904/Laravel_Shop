@extends('layout')
@section('content')


<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">

    <div class="container px-4 px-lg-5 mt-5">
        <form method="get" action="product/search">
            <!-- @csrf -->
            <input type="text" name="keyword" placeholder="search">
            <button type="submit">Tìm kiếm</button>
        </form>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach ($products as $product)
            <div class="card h-100">
                <!-- Product image-->
                <img class="card-img-top img-thumbnail" style="width: 200px;" src="{{$product->image}}" alt="..." />
                <!-- Product details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <!-- Product name-->
                        <h5 class="fw-bolder">{{$product->name}}</h5>
                        <!-- Product price-->
                        <strong style="color: red">{{$product->price}} vnđ</strong>
                    </div>
                </div>
                <!-- Product actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                            href="product/{{ $product->id }}">chi
                            tiết</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
    
</section>
@endsection