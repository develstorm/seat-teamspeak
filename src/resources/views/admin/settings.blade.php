@extends('teamspeak::admin.layouts.view', ['viewname' => 'config'])

@section('title', trans('teamspeak::ts.teamspeak'))
@section('page_header', trans('teamspeak::ts.overview'))

@section('config_content')

    <div class="row">
        <div class="col-md-8 col-sm-8 col-xs-16">

            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-key"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"></span>
                    <span class="info-box-number"></span>
            <span class="text-muted">
              <p>
                  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">...</button>
                    <div id="demo" class="collapse">
                        <div style="width:160%;background:slategrey;margin-top:60px;margin-left:-110%;padding: 10px;color:whitesmoke;position:absolute;">
                            {{ print_r($info) }}
                        </div>
                    </div>
                    <br><br>
                    Hier könnte ihre Werbung stehen
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

