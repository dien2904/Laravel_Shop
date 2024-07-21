<h2>User Management</h2>

<table class="table">
    <a href="{{route('user.create')}}"><button type="button" class="btn btn-success" >Add new User</button></a> 
    <thead>
      <tr>
        <th scope="col" >
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th scope="col">ID</th>
        <th scope="col">Image</th>
        <th scope="col" class="text-center">Information</th>
        <th scope="col" class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
        @if($users !== null)
        @foreach($users as $user)
        <tr>
            <th scope="col" >
                <input type="checkbox" value="" id="checkitem" class="input-checkbox">
            </th>
            <th scope="row">{{$user->id}}</th>
            <td>
                <span class="image"><img src="https://png.pngtree.com/png-vector/20190805/ourlarge/pngtree-account-avatar-user-abstract-circle-background-flat-color-icon-png-image_1650938.jpg" alt="" width="50px"></span>
            </td>
            <td class="text-center">
                <div class="user-item"><strong>Name: {{$user->name}}</strong></div>
                <div class="user-item"><strong>Email: {{$user->email}}</strong></div>
                <div class="user-item"><strong>Role: {{$user->role}}</strong></div>
            </td>
            <td class="text-center">
                <div>
                    <a href="{{ route('user.update',$user->id) }}"><button type="button" class="btn btn-primary">Edit</button></a>
                    <a href="{{ route('user.delete',$user->id) }}"><button type="button" class="btn btn-danger">Delete</button></a>
                </div>
                
            </td>
            
        </tr>
        @endforeach
      @endif
    </tbody>
  </table>

  {{ $users->links('pagination::bootstrap-4') }}