<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Detail</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Order Detail</h2>
        <div class="card">
            <div class="card-header">
                Order ID: {{ $order->id }}
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($order->orderItems->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">No items found.</td>
                            </tr>
                        @else
                            @foreach ($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->product_id }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <a href="{{ route('order.index') }}" class="btn btn-info mt-3">Back to Orders List</a>
    </div>
</body>
</html>
