
<Strong><h2>Create User</h2></Strong>
<form method="POST" action="{{ route('user.create') }}">
  @method('POST')
  @csrf
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputPassword4"><strong>Name</strong></label>
      <input type="text" class="form-control"  placeholder="Name" id="name">
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4"><strong>Email</strong></label>
      <input type="email" class="form-control"  placeholder="Email" id="email">
    </div>
    
  </div>
    <div class="form-row">

      <div class="form-group col-md-6">
        <label for="inputEmail4"><strong>Password</strong></label>
        <input type="password" class="form-control"  placeholder="Password" id="password">
      </div>
      <div class="form-group col-md-6">
        <label for="inputPassword4"><strong>Phone</strong></label>
        <input type="phone" class="form-control"  placeholder="Phone" id="phone">
      </div>
    </div>

    
    {{-- <div class="form-group">
      <label for="inputAddress"><strong>Address</strong></label>
      <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" id="address">
    </div> --}}



    {{-- <div class="form-group">
      <label for="inputAddress2">Address 2</label>
      <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
    </div> --}}
    {{-- <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputCity">City</label>
        <input type="text" class="form-control" id="inputCity">
      </div>
      <div class="form-group col-md-4">
        <label for="inputState">State</label>
        <select id="inputState" class="form-control">
          <option selected>Choose...</option>
          <option>...</option>
        </select>
      </div>
      <div class="form-group col-md-2">
        <label for="inputZip">Zip</label>
        <input type="text" class="form-control" id="inputZip">
      </div>
    </div> --}}
    <div class="form-group">
      {{-- <div class="form-check">
        <input class="form-check-input" type="checkbox" id="gridCheck">
        <label class="form-check-label" for="gridCheck">
          Check me out
        </label>
      </div> --}}
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
  </form>
