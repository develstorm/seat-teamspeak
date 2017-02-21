@extends('teamspeak::admin.settings', ['s_viewname' => 'configuration'])

@section('settings_content')

    <div class="col-md-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Configuration</h3>
        </div>
        <div class="panel-body">
            <form role="form" action="{{ route('teamspeak.configuration.post') }}" method="post" class="form-horizontal">
                {{ csrf_field() }}

                <div class="box-body">

                    <legend>Teamspeak</legend>

                    <div class="form-group">
                        <label for="teamspeak_token" class="col-md-4">Server Hostname</label>
                        <div class="col-md-7">
                            <div class="input-group input-group-sm">
                                @if ($tsHostname == null)
                                    <input type="text" class="form-control" id="teamspeak_hostname" name="teamspeak_hostname" />
                                @else
                                    <input type="text" class="form-control" id="teamspeak_hostname" name="teamspeak_hostname" value="{{ $tsHostname }}" />
                                @endif
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-danger btn-flat" id="hostname-eraser">
                                        <i class="fa fa-eraser"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="teamspeak_port" class="col-md-4">Server Port</label>
                        <div class="col-md-7">
                            <div class="input-group input-group-sm">
                                @if ($tsServerPort == null)
                                    <input type="text" class="form-control" id="teamspeak_port" name="teamspeak_port" />
                                @else
                                    <input type="text" class="form-control" id="teamspeak_port" name="teamspeak_port" value="{{ $tsServerPort }}" />
                                @endif
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-danger btn-flat" id="port-eraser">
                                        <i class="fa fa-eraser"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="teamspeak_query" class="col-md-4">Server Query Port</label>
                        <div class="col-md-7">
                            <div class="input-group input-group-sm">
                                @if ($tsServerQuery == null)
                                    <input type="text" class="form-control" id="teamspeak_query" name="teamspeak_query" />
                                @else
                                    <input type="text" class="form-control" id="teamspeak_query" name="teamspeak_query" value="{{ $tsServerQuery }}" />
                                @endif
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-danger btn-flat" id="query-eraser">
                                        <i class="fa fa-eraser"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="teamspeak_username" class="col-md-4">Server Query Username</label>
                        <div class="col-md-7">
                            <div class="input-group input-group-sm">
                                @if ($tsUsername == null)
                                    <input type="text" class="form-control" id="teamspeak_username" name="teamspeak_username" />
                                @else
                                    <input type="text" class="form-control" id="teamspeak_username" name="teamspeak_username" value="{{ $tsUsername }}" />
                                @endif
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-danger btn-flat" id="username-eraser">
                                        <i class="fa fa-eraser"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="teamspeak_password" class="col-md-4">Server Query Password</label>
                        <div class="col-md-7">
                            <div class="input-group input-group-sm">
                                @if ($tsPassword == null)
                                    <input type="text" class="form-control" id="teamspeak_password" name="teamspeak_password" />
                                @else
                                    <input type="password" class="form-control" id="teamspeak_password" name="teamspeak_password" value="{{ $tsPassword }}" />
                                @endif
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-danger btn-flat" id="password-eraser">
                                        <i class="fa fa-eraser"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <button id="submit" type="submit" class="btn btn-primary pull-right">Update</button>
                </div>

            </form>
        </div>
    </div>
    </div>
    <div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Commands</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="col-md-12">
                    @if($greenSettings == '')
                        <a href="#" type="button" class="btn btn-success btn-md col-md-12 disabled" role="button">Update TS server groups</a>
                    @else
                        <a href="{{ route('teamspeak.command.run', ['commandName' => 'teamspeak:groups:update']) }}" type="button" class="btn btn-success btn-md col-md-12" role="button">Update TS server groups</a>
                    @endif
                    <span class="help-block">
                        This will update known Teamspeak server groups.
                    </span>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@stop
@push('javascript')
    <script type="application/javascript">
        $('#hostname-eraser').click(function(){
            $('#teamspeak_hostname').val('');
        });

        $('#port-eraser').click(function(){
            $('#teamspeak_port').val('');
        });

        $('#query-eraser').click(function(){
            $('#teamspeak_query').val('');
        });

        $('#username-eraser').click(function(){
            $('#teamspeak_username').val('');
        });

        $('#password-eraser').click(function(){
            $('#teamspeak_password').val('');
        });

        $('[data-toggle="tooltip"]').tooltip();
    </script>
@endpush