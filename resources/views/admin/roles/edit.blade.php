@extends('admin.layouts.master')
@section('navbar')
@include('admin.layouts.navbar')
@stop
@section('content')
<div id="app">
 <div class="panel panel-primary">
   <div class="panel-heading">EDIT  ROLE</div>

    <div class="panel-body">
      <form method="post" action="{{route('roles.update',$role->id)}}">
       {{csrf_field()}}
       {{ method_field('PATCH') }}

         <div class="form-group">
           <label >Role:</label>
           <input type="text" class="form-control" name="name" value="{{$role->name}}">
        </div>
        <div class="form-group">
            <label for="pwd">Label:</label>
            <input type="text" class="form-control" name="label" value="{{$role->label}}">
       </div>

  <button type="submit" class="btn btn-default">Add Role</button>
  <a class="btn btn-warning" href="{{route('roles.index')}}">Go Back </a>
</form>
</div>
</div>
</div>
@include('admin.layouts.errors')

@stop