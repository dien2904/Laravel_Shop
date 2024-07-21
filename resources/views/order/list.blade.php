<h2>Order Management</h2>

<table class="table">
    {{-- <a href="{{route('user.create')}}"><button type="button" class="btn btn-success" >Add new User</button></a>  --}}
    <thead>
      <tr>
        <th scope="col" >
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th scope="col" class="text-center">Order ID</th>
        
        <th scope="col" class="text-center">Information</th>
        <th scope="col">Status</th>
        <th scope="col" class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
       
        @foreach($orders as $order)
        <tr>
            <th scope="col" >
                <input type="checkbox" value="" id="checkitem" class="input-checkbox">
            </th>
            <th class="text-center" scope="row">{{$order->id}}</th>
            
            <td class="text-center">
                <div class="user-item"><strong>User ID: {{$order->user_id}}</strong></div>
                <div class="user-item"><strong>Created at: {{$order->created_at}}</strong></div>
                {{-- <div class="user-item"><strong>Update at: {{$order->updated_at}}</strong></div> --}}
            </td>
            <td>
                <span><strong>{{$order->order_status}}</strong></span>
            </td>
            <td class="text-center">
                <div>
                    <a href="{{route('order.show',$order->id)}}">View Detail</a>
                    <a href="{{route('order.edit',$order->id) }}"><button type="button" class="btn btn-primary">Edit</button></a>
                    <a href="{{route('order.destroy',$order->id) }}"><button type="button" class="btn btn-danger">Delete</button></a>
                </div>
                
            </td>
            
        </tr>
        @endforeach
   
    </tbody>
  </table>

  {{ $orders->links('pagination::bootstrap-4') }}