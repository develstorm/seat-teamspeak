@extends('teamspeak::overview.layouts.view', ['viewname' => 'register'])

@section('title', trans('teamspeak::ts.teamspeak'))
@section('page_header', 'Registration')

@section('teamspeak_content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-24">

            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-briefcase"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"></span>
                    <span class="info-box-number"></span>
            <span class="text-muted">
              <p>
                  Registrierungsstatus: keinPlan
              </p>
            </span>

                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->

        </div><!-- /.col -->
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-24">
            <div class="box box-info">
                <div class="box-body">
                    Registrierungsanweisungen

                    <br><br>Register your TeamSpeak Identity to your User Account
                    <br>In order to register with TeamSpeak, you must first connect to our TeamSpeak.
                    <br>If you do not have TeamSpeak already installed, please download and install TeamSpeak 3 from <a href="http://www.teamspeak.com/?page=downloads">here</a>
                    <br>Please use the following settings to connect:

                    <br><br>Address - ts3.eve-igc.de

                    <br><br>Benutzername:


                    <br><br><br>Your TeamSpeak Unique ID:
                </div>
            </div>
        </div>
    </div>

@stop



@push('javascript')
<script>

    console.log('Include anay JavaScript you may need here!');

</script>
@endpush
