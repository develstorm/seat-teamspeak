@extends('web::layouts.grids.12')

@section('title', trans('teamspeak::ts.teamspeak'))
@section('page_header', trans('teamspeak::ts.overview'))

@section('full')

  <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">

      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-server"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">{{ trans('teamspeak::ts.online') }}</span>
          <span class="info-box-number">
            {{ $count or trans('teamspeak::ts.unknown') }}
          </span>
          <span class="text-muted">
            <p>
              @include('teamspeak::partials.viewer')
            </p>
          </span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->

    </div><!-- /.col -->
    <div class="col-md-6 col-sm-6 col-xs-12">

      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-key"></i></span>
        <div class="info-box-content">
          <span class="info-box-text"></span>
          <span class="info-box-number"></span>
            <span class="text-muted">
              <p>
                @include('teamspeak::partials.settings')
              </p>
            </span>

        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->

    </div><!-- /.col -->
  </div>

@stop

@push('javascript')
<script>

  console.log('Include anay JavaScript you may need here!');

</script>
@endpush
