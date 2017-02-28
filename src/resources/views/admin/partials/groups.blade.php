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
                        <th>Main Group</th>
                        <th>Functions</th>
                    </tr>
                    @foreach($groups as $group)
                    <tr>
                        <td>{{$group['id']}}</td>
                        <td>{{$group['name']}}</td>
                        <td>{{$group['is_server_group']}}</td>
                        <td>{{$group['main_group']}}</td>
                        <td>Options</td>
                     </tr>
                    @endforeach
                </table>

            </div>
            <div class="panel-footer clearfix">
                Button
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Default Groups</h3>
            </div>
            <div class="panel-body">

                <form role="form" action="{{ route('teamspeak.defaults.post') }}" method="post">
                    {{ csrf_field() }}

                    <div class="box-body" >

                        <div class="form-group">
                            <label for="defaults-1">{{ trans('teamspeak::ts.defaults.1') }}</label>
                            <select name="defaults-1" id="defaults-1" class="col-md-12" style="width: 100%" required>
                                @foreach($groups as $group)
                                    @if($group->main_group == '1')
                                        <option selected value="{{ $group->id }}">{{ $group->name }}</option>
                                    @else
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endif
                                    @if($group->main_group == '1')
                                        {{ $set = 1 }}
                                    @endif
                                @endforeach
                                @if(!$set)
                                        <option selected hidden value="0">- Not Sellected</option>
                                @endif
                            </select>
                        </div>

                         <div class="form-group">
                            <label for="defaults-2">{{ trans('teamspeak::ts.defaults.2') }}</label>
                            <select name="defaults-2" id="defaults-2" class="col-md-12" style="width: 100%" required>
                                {{ $set = 0 }}
                                @foreach($groups as $group)
                                    @if($group->main_group == '2')
                                        <option selected value="{{ $group->id }}">{{ $group->name }}</option>
                                    @else
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endif
                                        @if($group->main_group == '2')
                                            {{ $set = 1 }}
                                        @endif
                                @endforeach
                                @if(!$set)
                                    <option selected hidden value="0">- Not Sellected</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="defaults-3">{{ trans('teamspeak::ts.defaults.3') }}</label>
                            <select name="defaults-3" id="defaults-3" class="col-md-12" style="width: 100%" required>
                                {{ $set = 0 }}
                                @foreach($groups as $group)
                                    @if($group->main_group == '3')
                                        <option selected value="{{ $group->id }}">{{ $group->name }}</option>
                                    @else
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endif
                                    @if($group->main_group == '3')
                                        {{ $set = 1 }}
                                    @endif
                                @endforeach
                                @if(!$set)
                                    <option selected hidden value="0">- Not Sellected</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="defaults-4">{{ trans('teamspeak::ts.defaults.4') }}</label>
                            <select name="defaults-4" id="defaults-4" class="col-md-12" style="width: 100%" required>
                                {{ $set = 0 }}
                                @foreach($groups as $group)
                                    @if($group->main_group == '4')
                                        <option selected value="{{ $group->id }}">{{ $group->name }}</option>
                                    @else
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endif
                                    @if($group->main_group == '4')
                                        {{ $set = 1 }}
                                    @endif
                                @endforeach
                                @if(!$set)
                                    <option selected hidden value="0">- Not Sellected</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="defaults-5">{{ trans('teamspeak::ts.defaults.5') }}</label>
                            <select name="defaults-5" id="defaults-5" class="col-md-12" style="width: 100%" required>
                                {{ $set = 0 }}
                                @foreach($groups as $group)
                                    @if($group->main_group == '5')
                                        <option selected value="{{ $group->id }}">{{ $group->name }}</option>
                                    @else
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endif
                                    @if($group->main_group == '5')
                                        {{ $set = 1 }}
                                    @endif
                                @endforeach
                                @if(!$set)
                                    <option selected hidden value="0">- Not Sellected</option>
                                @endif
                            </select>
                        </div>


                    </div>
                </form>
            </div>
            <div class="panel-footer clearfix">
                <button type="submit" class="btn btn-primary pull-right">{{ trans('teamspeak::ts.save') }}</button>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Special Groups</h3>
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
                        <tr>
                            <td>{{$group['id']}}</td>
                            <td>{{$group['name']}}</td>
                            <td>{{$group['is_server_group']}}</td>
                            <td>Options</td>
                        </tr>
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
                Button
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
