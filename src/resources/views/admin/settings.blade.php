@extends('teamspeak::admin.layouts.view', ['viewname' => 'config'])

@section('title', trans('teamspeak::ts.teamspeak'))
@section('page_header', trans('teamspeak::ts.overview'))

@section('config_content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-24">

                    @yield('settings_content')


        </div>
    </div>
@stop



