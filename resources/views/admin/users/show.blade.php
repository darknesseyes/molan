@extends('admin.layouts.master')

@section('navbar')
@include('admin.layouts.navbar')
@stop

@section('content')
<a href="{{route('users.create')}}" class="btn btn-primary">Create New User</a>
<div class="spacer"></div>

<div id='app'>
 <div class="panel panel-primary">
   <div class="panel-heading">Panel Heading</div>
    <div class="panel-body">
@include('admin.users._users_list')
  </div>
</div>
</div>
@stop
