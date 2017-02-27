@extends('teamspeak::admin.settings', ['s_viewname' => 'list'])

@section('settings_content')

    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <a href="#show" data-toggle="collapse">
                    <i class="fa fa-plus"></i>
                 {{ trans('teamspeak::ts.quick_create') }}</a></h3>
        </div>
        <div class="panel-body collapse" data-toggle="collapse" id="show">
            <form role="form" action="{{ route('teamspeak.add') }}" method="post">
                {{ csrf_field() }}

                <div class="box-body" >

                    <div class="form-group">
                        <label for="teamspeak-type">{{ trans('teamspeak::ts.type') }}</label>
                        <select name="teamspeak-type" id="teamspeak-type" class="col-md-12" style="width: 100%">
                            <option value="user">{{ trans('teamspeak::ts.user_filter') }}</option>
                            <option value="role">{{ trans('teamspeak::ts.role_filter') }}</option>
                            <option value="corporation">{{ trans('teamspeak::ts.corporation_filter') }}</option>
                            <option value="alliance">{{ trans('teamspeak::ts.alliance_filter') }}</option>
                            <option value="public">{{ trans('teamspeak::ts.public_filter') }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="teamspeak-user-id">{{ trans('teamspeak::ts.username') }}</label>
                        <select name="teamspeak-user-id" id="teamspeak-user-id" class="col-md-12" style="width: 100%">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="teamspeak-role-id">{{ trans('teamspeak::ts.role') }}</label>
                        <select name="teamspeak-role-id" id="teamspeak-role-id" class="col-md-12" disabled="disabled" style="width: 100%">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="teamspeak-corporation-id">{{ trans('teamspeak::ts.corporation') }}</label>
                        <select name="teamspeak-corporation-id" id="teamspeak-corporation-id" class="col-md-12" disabled="disabled" style="width: 100%">
                            @foreach($corporations as $corporation)
                                <option value="{{ $corporation->corporationID }}">{{ $corporation->corporationName }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="teamspeak-alliance-id">{{ trans('teamspeak::ts.alliance') }}</label>
                        <select name="teamspeak-alliance-id" id="teamspeak-alliance-id" class="col-md-12" disabled="disabled" style="width: 100%">
                            @foreach($alliances as $alliance)
                                <option value="{{ $alliance->allianceID }}">{{ $alliance->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="teamspeak-group-id">{{ trans('teamspeak::ts.groups') }}</label>
                        <select name="teamspeak-group-id" id="teamspeak-group-id" class="col-md-12" style="width: 100%">
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="teamspeak-enabled">{{ trans('teamspeak::ts.enabled') }}</label>
                        <input type="checkbox" name="teamspeak-enabled" id="teamspeak-enabled" checked="checked" value="1" />
                    </div>

                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">{{ trans('teamspeak::ts.add') }}</button>
                </div>

            </form>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('teamspeak::ts.authorisations') }}</h3>
        </div>
        <div class="panel-body">

            <ul class="nav nav-pills" id="teamspeak-tabs">
                <li role="presentation" class="active">
                    <a href="#teamspeak-public">{{ trans('teamspeak::ts.public_filter') }}</a>
                </li>
                <li role="presentation">
                    <a href="#teamspeak-username">{{ trans('teamspeak::ts.user_filter') }}</a>
                </li>
                <li role="presentation">
                    <a href="#teamspeak-role">{{ trans('teamspeak::ts.role_filter') }}</a>
                </li>
                <li role="presentation">
                    <a href="#teamspeak-corporation">{{ trans('teamspeak::ts.corporation_filter') }}</a>
                </li>
                <li role="presentation">
                    <a href="#teamspeak-alliance">{{ trans('teamspeak::ts.alliance_filter') }}</a>
                </li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="teamspeak-public">
                    <table class="table table-condensed table-hover table-responsive">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('teamspeak::ts.groups') }}</th>
                            <th>{{ trans('teamspeak::ts.created') }}</th>
                            <th>{{ trans('teamspeak::ts.updated') }}</th>
                            <th>{{ trans('teamspeak::ts.status') }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($groupPublic as $group)
                            <tr>
                                <td></td>
                                <td>{{ $group->group->name }}</td>
                                <td>{{ $group->created_at }}</td>
                                <td>{{ $group->updated_at }}</td>
                                <td>{{ $group->enable }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('teamspeak.public.remove', ['group_id' => $group->group_id]) }}" type="button" class="btn btn-danger btn-xs col-xs-12">
                                            {{ trans('web::seat.remove') }}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="teamspeak-username">
                    <table class="table table-condensed table-hover table-responsive">
                        <thead>
                        <tr>
                            <th>{{ trans('teamspeak::ts.username') }}</th>
                            <th>{{ trans('teamspeak::ts.groups') }}</th>
                            <th>{{ trans('teamspeak::ts.created') }}</th>
                            <th>{{ trans('teamspeak::ts.updated') }}</th>
                            <th>{{ trans('teamspeak::ts.status') }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($groupUsers as $group)
                            <tr>
                                <td>{{ $group->user->name }}</td>
                                <td>{{ $group->group->name }}</td>
                                <td>{{ $group->created_at }}</td>
                                <td>{{ $group->updated_at }}</td>
                                <td>{{ $group->enable }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('teamspeak.user.remove', ['user_id' => $group->user_id, 'group_id' => $group->group_id]) }}" type="button" class="btn btn-danger btn-xs col-xs-12">
                                            {{ trans('web::seat.remove') }}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="teamspeak-role">
                    <table class="table table-condensed table-hover table-responsive">
                        <thead>
                        <tr>
                            <th>{{ trans('teamspeak::ts.role') }}</th>
                            <th>{{ trans('teamspeak::ts.groups') }}</th>
                            <th>{{ trans('teamspeak::ts.created') }}</th>
                            <th>{{ trans('teamspeak::ts.updated') }}</th>
                            <th>{{ trans('teamspeak::ts.status') }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($groupRoles as $group)
                            <tr>
                                <td>{{ $group->role->title }}</td>
                                <td>{{ $group->group->name }}</td>
                                <td>{{ $group->created_at }}</td>
                                <td>{{ $group->updated_at }}</td>
                                <td>{{ $group->enable }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('teamspeak.role.remove', ['role_id' => $group->role_id, 'group_id' => $group->group_id]) }}" type="button" class="btn btn-danger btn-xs col-xs-12">
                                            {{ trans('web::seat.remove') }}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="teamspeak-corporation">
                    <table class="table table-condensed table-hover table-responsive">
                        <thead>
                        <tr>
                            <th>{{ trans('teamspeak::ts.corporation') }}</th>
                            <th>{{ trans('teamspeak::ts.groups') }}</th>
                            <th>{{ trans('teamspeak::ts.created') }}</th>
                            <th>{{ trans('teamspeak::ts.updated') }}</th>
                            <th>{{ trans('teamspeak::ts.status') }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($groupCorporations as $group)
                            <tr>
                                <td>{{ $group->corporation->corporationName }}</td>
                                <td>{{ $group->group->name }}</td>
                                <td>{{ $group->created_at }}</td>
                                <td>{{ $group->updated_at }}</td>
                                <td>{{ $group->enable }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('teamspeak.corporation.remove', ['corporation_id' => $group->corporation_id, 'group_id' => $group->group_id]) }}" type="button" class="btn btn-danger btn-xs col-xs-12">
                                            {{ trans('web::seat.remove') }}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="teamspeak-alliance">
                    <table class="table table-condensed table-hover table-responsive">
                        <thead>
                        <tr>
                            <th>{{ trans('teamspeak::ts.alliance') }}</th>
                            <th>{{ trans('teamspeak::ts.groups') }}</th>
                            <th>{{ trans('teamspeak::ts.created') }}</th>
                            <th>{{ trans('teamspeak::ts.updated') }}</th>
                            <th>{{ trans('teamspeak::ts.status') }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($groupAlliances as $group)
                            <tr>
                                <td>{{ $group->alliance->name }}</td>
                                <td>{{ $group->group->name }}</td>
                                <td>{{ $group->created_at }}</td>
                                <td>{{ $group->updated_at }}</td>
                                <td>{{ $group->enable }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('teamspeak.alliance.remove', ['alliance_id' => $group->alliance_id, 'group_id' => $group->group_id]) }}" type="button" class="btn btn-danger btn-xs col-xs-12">
                                            {{ trans('web::seat.remove') }}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('javascript')
    <script type="application/javascript">
        $('#teamspeak-type').change(function(){
            $.each(['teamspeak-user-id', 'teamspeak-role-id', 'teamspeak-corporation-id', 'teamspeak-alliance-id'], function(key, value){
                if (value == ('teamspeak-' + $('#teamspeak-type').val() + '-id')) {
                    $(('#' + value)).prop('disabled', false);
                } else {
                    $(('#' + value)).prop('disabled', true);
                }
            });
        }).select2();

        $('#teamspeak-user-id, #teamspeak-role-id, #teamspeak-corporation-id, #teamspeak-alliance-id, #teamspeak-group-id').select2();

        $('#teamspeak-tabs a').click(function(e){
            e.preventDefault();
            $(this).tab('show');
        });
    </script>
@endpush
