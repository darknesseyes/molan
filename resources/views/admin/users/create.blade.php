  @extends('admin.layouts.master')
@section('navbar')
@include('admin.layouts.navbar')
@stop
@section('content')
  <form method="post" action="{{route('users.store')}}">
  {{csrf_field()}}
      <div class="form-group">
      <label >Name:</label>
      <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{old('name')}}">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{old('email')}}">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" name="password" placeholder="Enter password">
    </div>
        <div class="form-group">
      <label for="pwd">Password Comfirmation:</label>
      <input type="password" class="form-control" name="password_confirmation" placeholder="Retype Your Password">
    </div>
    <div class="form-group">
      <label for="sel1">Select the Role</label>
      <select class="form-control" name="role">
      @foreach($roles as $role)
        <option value="{{$role->id}}">{{$role->name}}</option>
      @endforeach
      </select>
      </div>
    <button type="submit" class="btn btn-default">Create New User</button>
  </form>
  @include('admin.layouts.errors')

@stop