@extends('admin.layouts.master')

@section('navbar')
@include('admin.layouts.navbar')
@stop

@section('content')


 <div class="panel panel-primary">
   <div class="panel-heading">{{$role->label}}</div>
    <div class="panel-body">
 <div class="row">
<div class="col-md-6 col-lg-6">
<h5> Available Permissions : Click to Add permissions</h5>
@if(count($permissions))
<ul class="list-group">
@foreach($permissions as $permission)
<a href="{{url('/role')}}/{{$role->id}}/assignPermission/{{$permission->id}}" class="list-group-item"> {{$permission->label}} </a>
@endforeach
</ul>
@endif
</div><!-- end of first colomn -->
<div class="col-md-6 col-lg-6">
<h5>Related Permissions : Click to remove a permission</h5>
<ul class="list-group">
@foreach($role->permissions as $permission)
<a href="{{url('/role')}}/{{$role->id}}/removePermission/{{$permission->id}}"  class="list-group-item">{{$permission->label}}</a>
@endforeach
@if(!count($role->permissions))
<li class="list-group-item alert alert-danger">You don't have permissions </li>
@endif

</ul>
</div><!-- end of first colomn -->
 </div><!-- end of class row -->
  </div><!-- end of panel-body -->
</div><!-- end of div panel panel-primary -->

@stop

