<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Administration</h3>
    </div>


    <div style="padding-bottom: 15px;">

        <ul class="nav nav-tabs nav-stacked">

            @foreach($menu as $menu_entry)

                @if(auth()->user()->has($menu_entry['permission']))

                    <li role="presentation"
                        class="@if ($s_viewname == $menu_entry['highlight_view']) active @endif">

                        <a href="{{ route($menu_entry['route']) }}">
                            @if (array_key_exists('label', $menu_entry))
                                @if(array_key_exists('plural', $menu_entry))
                                    {{ trans_choice($menu_entry['label'], 2) }}
                                @else
                                    {{ trans($menu_entry['label']) }}
                                @endif
                            @else
                                {{ $menu_entry['name'] }}
                            @endif
                        </a>

                    </li>

                @endif

            @endforeach

        </ul>

    </div>
</div>