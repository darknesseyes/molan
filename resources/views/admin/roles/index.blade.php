@extends('admin.layouts.master')

@section('navbar')
@include('admin.layouts.navbar')
@stop

@section('content')
<a href="{{route('roles.create')}}" class="btn btn-primary">Create New Role</a>
<div class="spacer"></div>

<div id='app'>
 <div class="panel panel-primary">
   <div class="panel-heading">Panel Heading</div>
    <div class="panel-body">
@include('admin.roles._roles_list')
  </div>
</div>
</div>
@stop
