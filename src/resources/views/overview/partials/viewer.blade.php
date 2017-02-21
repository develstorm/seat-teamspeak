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

        <div class="box box-info">
                <div class="box-body">
                        {{--@include('teamspeak::overview.partials.viewer')--}}
                        {{ print $viewer }}
                </div>
        </div>
</div><!-- /.col -->





