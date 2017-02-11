@extends('admin.layouts.master')
@section('navbar')
@include('admin.layouts.navbar')
@stop
@section('content')
<form method="post" action="{{route('permissions.update',$permission->id)}}">
{{csrf_field()}}
{{ method_field('PATCH') }}

  <div class="form-group">
    <label >Permission:</label>
    <input type="text" class="form-control" name="name" value="{{$permission->name}}">
  </div>
  <div class="form-group">
    <label for="pwd">Label:</label>
    <input type="text" class="form-control" name="label" value="{{$permission->label}}">
  </div>

  <button type="submit" class="btn btn-default">Add Permission</button>
  <a class="btn btn-warning" href="{{route('roles.index')}}">Go Back </a>
</form>


@include('admin.layouts.errors')
@stop