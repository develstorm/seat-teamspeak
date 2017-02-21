@extends('web::layouts.grids.12')

@section('full')

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-24">

            @include('teamspeak::includes.menu')

        </div>

    </div>
    <div class="row">

        <div class="col-md-2 col-sm-2 col-xs-4">
            <div class="box box-info">

            @include('teamspeak::admin.includes.menu')

            </div>

        </div>
        <div class="col-md-10 col-sm-10 col-xs-20">

            @yield('config_content')

        </div>

    </div>

@stop
