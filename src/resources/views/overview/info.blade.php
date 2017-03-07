@extends('teamspeak::overview.layouts.view', ['viewname' => 'info'])

@section('title', trans('teamspeak::ts.teamspeak'))
@section('page_header', trans('teamspeak::ts.overview'))

@section('teamspeak_content')
<div class="row">

    <div class="col-md-8 col-sm-8 col-xs-16">

      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-key"></i></span>
        <div class="info-box-content">
          <h4 class="box-title">Teamspeak Rules & Statistics</h4>
          <span class="info-box-text"></span>
          <span class="info-box-number"></span>
            <span class="text-muted">
              <p>
                More to come...
              </p>
            </span>

        </div>
      </div>

      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">General Rules</h3>
        </div>
        <div class="box-body">
           1. <a href="https://github.com/SauerRam/seat-teamspeak">Teamspeak</a><br>
          2. <a href="https://github.com/SauerRam/seat-forum">Forum</a><br>
          3. <a href="https://github.com/SauerRam/seat-forum-frontend">Forum Frontend</a><br>
          4. <a href="https://github.com/SauerRam/seat-mainframe">Mainframe</a>

        </div>
      </div>
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">General Statistics</h3>
        </div>
        <div class="box-body">
          Online Time<br>
          Average Users<br>
          Traffic<br>
          Storm
        </div>
      </div>
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">User Statistics</h3>
        </div>
        <div class="box-body">
          Connection Times<br>
          Last IP: <br>
          Avatar
        </div>

      </div>
    </div>

    @include('teamspeak::overview.partials.viewer')
</div>
@stop



@push('javascript')
<script>

  console.log('Include anay JavaScript you may need here!');

</script>
@endpush
