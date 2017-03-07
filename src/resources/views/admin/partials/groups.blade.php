@extends('teamspeak::admin.settings', ['s_viewname' => 'groups'])

@section('settings_content')

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Server Groups</h3>
            </div>
            <div class="panel-body">

                <table class="table table-condensed table-hover table-responsive">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>ServerGroup</th>
                        <th>Functions</th>
                    </tr>
                    @foreach($groups as $group)
                        @if($group['type'] === 0)
                    <tr>
                        <td>{{$group['id']}}</td>
                        <td>{{$group['name']}}</td>
                        <td>
                            @if($group['is_server_group'])
                                <i class="fa fa-check" style="color:green" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-close" style="color:red" aria-hidden="true"></i>
                            @endif
                        </td>
                        <td>
                            @if($group['is_server_group'])
                                <a href="{{ route('teamspeak.groups.disable', ['group_id' => $group['id']]) }}" >
                                    <i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i>
                                </a>
                            @else
                                <a href="{{ route('teamspeak.groups.enable', ['group_id' => $group['id']]) }}" >
                                    <i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i>
                                </a>
                            @endif
                        </td>
                     </tr>
                        @endif
                    @endforeach
                </table>

            </div>
            <div class="panel-footer clearfix">
                <i class="fa fa-check" aria-hidden="true"></i> = Active
                <i class="fa fa-close" aria-hidden="true"></i> = Ignored

            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Template Groups Settings</h3>
            </div>
            <div class="panel-body">

                    {{ csrf_field() }}
                <form role="form" action="{{ route('teamspeak.corp.default') }}" method="post">
                    <div class="box-body" >
                            {{ csrf_field() }}

                            <div class="box-body" >
                                <div class="form-group">
                                    <label for="corp-template"> Corporation Template Group:</label>
                                    <select name="corp-template" id="corp-template" class="col-md-12" style="width: 100%">
                                        @foreach($groups as $group)
                                            @if($group['type'] === 1)
                                                @if($group['id'] == $template)
                                                    <option selected value="{{ $group['id'] }}">{{ $group['name'] }}</option>
                                                @else
                                                    <option value="{{ $group['id'] }}">{{ $group['name'] }}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        <button type="submit" class="btn btn-primary pull-right">{{ trans('teamspeak::ts.save') }}</button>
                    </div>
                </form>

            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Corporation Groups</h3>
            </div>
            <div class="panel-body">

                <table class="table table-condensed table-hover table-responsive">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>ServerGroup</th>
                        <th>Functions</th>
                    </tr>
                    @foreach($groups as $group)
                        @if($group['type'] == '1')
                        <tr>
                            <td>{{$group['id']}}</td>
                            <td>{{$group['name']}}</td>
                            <td>
                                @if($group['is_server_group'])
                                    <i class="fa fa-check" style="color:green" aria-hidden="true"></i>
                                @else
                                    <i class="fa fa-close" style="color:red" aria-hidden="true"></i>
                                @endif
                            </td>
                            <td>
                                @if($group['is_server_group'])
                                    <a href="{{ route('teamspeak.groups.disable', ['group_id' => $group['id']]) }}" >
                                        <i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i>
                                    </a>
                                @else
                                    <a href="{{ route('teamspeak.groups.enable', ['group_id' => $group['id']]) }}" >
                                        <i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i>
                                    </a>
                                @endif
                                    <i class="fa fa-close fa-2x" style="color:red" aria-hidden="true"></i>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </table>

            </div>
            <div class="panel-footer clearfix">
                Button
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Corporations</h3>
            </div>
            <div class="panel-body">

                <table class="table table-condensed table-hover table-responsive"
                    id="corp-table">
                    <thead>
                    <tr>
                        <th>{{ trans_choice('web::seat.name', 1) }}</th>
                        <th>{{ trans('web::seat.ceo') }}</th>
                        <th>{{ trans('web::seat.alliance') }}</th>
                        <th>{{ trans('web::seat.member_limit') }}</th>
                    </tr>
                    </thead>
                </table>

            </div>
            <div class="panel-footer clearfix">
                @foreach($allianceCorps as $corp)

                    {{$corp['corporationID']}}
                @endforeach
            </div>
        </div>

    </div>
@stop

@push('javascript')
<script>

    $(function () {
        $('table#corp-table').DataTable({
            processing      : true,
            serverSide      : true,
            ajax            : '{{ route('corporation.list.data') }}',
            columns         : [
                {data: 'corporationName', name: 'corporationName'},
                {data: 'ceoName', name: 'ceoName'},
                {data: 'allianceName', name: 'allianceName'},
                {data: 'memberCount', name: 'memberCount'},
            ],
            "fnDrawCallback": function () {
                $(document).ready(function () {
                    $("img").unveil(100);
                });
            }
        });
    });

</script>
@endpush
