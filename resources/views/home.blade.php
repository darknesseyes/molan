@extends('admin.layouts.master')
@section('navbar')
@include('admin.layouts.navbar')
@stop
@section('content')
<div class="container">
    <div class="row">
    @if(auth()->user()->active == 1)
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in! {{auth()->user()->name}}
                </div>
            </div>
        </div>
        @endif

            @if(auth()->user()->active == 0)
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-danger">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Welcome Mr. {{auth()->user()->name}} and waite till your account been verefied

                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
