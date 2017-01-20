@extends('web::layouts.grids.12')

@section('full')

    <div class="row">

        <div class="col-md-12">

            @include('teamspeak::includes.menu')

        </div>

    </div>
    <div class="row">

        <div class="col-md-12">

            {{--@include('teamspeak::admin.includes.menu')--}}

        </div>

    </div>

    @yield('config_content')



@stop
