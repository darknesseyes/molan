@extends('admin.layouts.master')
@section('navbar')
@include('admin.layouts.navbar')
@stop
@section('content')
<div id="app">
 <div class="panel panel-primary">
   <div class="panel-heading">CREATE NEW ROLE</div>

    <div class="panel-body">
      <form method="post" action="{{route('roles.store')}}">
       {{csrf_field()}}
         <div class="form-group">
           <label >Role:</label>
           <input type="text" class="form-control" name="name" id="name">
        </div>
        <div class="form-group">
            <label for="pwd">Label:</label>
            <input type="text" class="form-control" name="label" id="name">
       </div>

  <button type="submit" class="btn btn-default">Add Role</button>
  <a class="btn btn-warning" href="{{route('roles.index')}}">Go Back </a>
</form>
</div>
</div>
</div>
@include('admin.layouts.errors')

@stop