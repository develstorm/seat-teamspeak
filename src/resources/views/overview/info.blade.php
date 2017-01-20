@extends('teamspeak::overview.layouts.view', ['viewname' => 'info'])

@section('title', trans('teamspeak::ts.teamspeak'))
@section('page_header', trans('teamspeak::ts.overview'))

@section('teamspeak_content')

  <div class="row">
    <div class="col-md-8 col-sm-8 col-xs-16">

      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-key"></i></span>
        <div class="info-box-content">
          <span class="info-box-text"></span>
          <span class="info-box-number"></span>
            <span class="text-muted">
              <p>
                @include('teamspeak::overview.partials.settings')
              </p>
            </span>

        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->

    </div><!-- /.col -->

    <div class="col-md-4 col-sm-4 col-xs-8">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-server"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">
              {{ $info['virtualserver_name'] }}
            </span>
            <span class="info-box-number">
              {{ $info['virtualserver_clientsonline'] or trans('teamspeak::ts.unknown') }}
              {{ trans('teamspeak::ts.online') }}
            </span>
            <span class="text-muted">
              <p>
                {{ $info['virtualserver_welcomemessage'] }}
              </p>
            </span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->
  </div>

  <div class="row">
    <div class="col-md-8 col-sm-8 col-xs-16">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Settings?</h3>
        </div>
        <div class="box-body">
         bliblablub
        </div>
      </div>
    </div><!-- /.col -->

    <div class="col-md-4 col-sm-4 col-xs-8">
      <div class="box box-info">
        <div class="box-body">
          @include('teamspeak::overview.partials.viewer')
        </div>
      </div>
    </div><!-- /.col -->
  </div>
@stop



@push('javascript')
<script>

  console.log('Include anay JavaScript you may need here!');

</script>
@endpush
