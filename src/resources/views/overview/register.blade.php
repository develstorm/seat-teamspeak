@extends('teamspeak::overview.layouts.view', ['viewname' => 'register'])

@section('title', trans('teamspeak::ts.teamspeak'))
@section('page_header', 'Registration')

@section('teamspeak_content')
<div class="row">

        <div class="col-md-8 col-sm-8 col-xs-16">

            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"></span>
                    <span class="info-box-number"></span>
            <span class="text">
                <p>
                    Connection Status:
                </p>
              <p>
                  @if(!empty($status['client']))
                      <i class="fa fa-circle" style="color: lawngreen"></i> {{ $status['client'] }}
                  @else
                      <i class="fa fa-circle" style="color: red"></i> Client Not Connected
                  @endif
                  <br>
                  @if(!empty($status['user']))
                      <i class="fa fa-circle" style="color: lawngreen"></i> {{ $status['user'] }}
                  @else
                      <i class="fa fa-circle" style="color: red"></i> User Not Connected
                  @endif
              </p>
            </span>

                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->


            <div class="box box-info">
                <div class="box-body">
                    Registrierungsanweisungen

                    <br><br>Register your TeamSpeak Identity to your User Account
                    <br>In order to register with TeamSpeak, you must first connect to our TeamSpeak.
                    <br>If you do not have TeamSpeak already installed, please download and install TeamSpeak 3 from <a href="http://www.teamspeak.com/?page=downloads">here</a>
                    <br>Please use the following settings to connect:

                    <br><br>Address - ts3.eve-igc.de

                    <br><br>Benutzername:
                        @if(is_null(setting('main_character_name')))
                            <a href="{{ route('profile.view') }}">{{ trans('web::seat.no_main_char') }}!</a>
                        @else
                                {{ setting('main_character_name') }}
                        @endif

                    <br>Registered Unique ID: <b>{{ $user->TsUID }}</b>
                    <br>Client Unique ID: <b>
                                {{--{{ print_r($status['client']) }}--}}
                        @if($client['client_unique_identifier'])
                                {{ $client['client_unique_identifier'] }}
                        @else
                            not matching, wrong nickname?
                        @endif


                    </b>
                    <br>
                    <br>




                    <form role="form" action="{{ route('teamspeak.register.save') }}" method="post"
                          class="form-horizontal">
                        {{ csrf_field() }}

                        <div class="box-footer">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="submit"></label>
                                <div class="col-md-4">
                                    @if(!empty($status['client']))
                                    <button id="submit" type="submit" class="btn btn-primary">
                                        @if($user->TsUID != '')
                                            Update
                                        @else
                                            Register
                                        @endif

                                    </button>
                                    @else
                                    <button type="submit" disabled class="btn btn-default">
                                        Register
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
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
