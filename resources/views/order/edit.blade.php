<h2>Edit Order Status</h2>

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
    @endforeach

    <a href="{{route('order.index')}}" class="btn btn-info">List</a>
    <h3>Order Edit</h3>
    <form method="post" action="{{route('order.update', $result->id)}}">
        @csrf
        @method('PUT')

        <strong><h5>User ID</h5></strong>
        <input class="form-control" placeholder="enter name" type="text" name="user_id" value="{{ old('user_id', $result->user_id) }}">
        <br>

        <strong><h5>Created At</h5></strong>
        <input class="form-control mt-3" placeholder="enter date" type="text" name="created_at" value="{{ old('created_at', $result->created_at) }}">
        <br>

        <strong><h5>Order Status</h5></strong>
        <select class="form-control mt-3" name="order_status">
            <option value="Pending" {{ old('order_status', $result->order_status) == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="Completed" {{ old('order_status', $result->order_status) == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="Canceled" {{ old('order_status', $result->order_status) == 'canceled' ? 'selected' : '' }}>Canceled</option>
            <option value="Refund" {{ old('order_status', $result->order_status) == 'refund' ? 'selected' : '' }}>Refund</option>
        </select>

        <input type="submit" class="btn btn-primary mt-3" value="Edit">
    </form>
</div>
