@extends('admin.layouts.master')

@section('navbar')
@include('admin.layouts.navbar')
@stop

@section('content')
<a href="{{route('permissions.create')}}" class="btn btn-primary">Create New Permission</a>

<div class="spacer"></div>
<div id='app'>

 <div class="panel panel-primary">
   <div class="panel-heading">Panel Heading</div>

    <div class="panel-body">
@include('admin.permissions._permissions_list')
  </div>
</div>
</div>



<!-- end of permissions idex -->


@stop