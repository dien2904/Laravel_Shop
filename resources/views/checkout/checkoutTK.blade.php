@extends('layout');
@section('content');

<style>
    h1 {
        color: green;
        text-align: center;
    }

    .flex {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
</style>
<div class="container">
    <div class="flex">
        <h1>Your order is Processing. Thank You</h1>
        <a class="btn btn-primary" href="{{url('shop')}}">back to shop</a>
    </div>
</div>
@endsection