@extends('web::layouts.grids.12')

@section('full')

    <div class="row">

        <div class="col-md-12">

            @include('teamspeak::includes.menu')

        </div>

    </div>

            @yield('teamspeak_content')



@stop
