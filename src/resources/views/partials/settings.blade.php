<div class="row">
    <div class="container">
        <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">...</button>
        <div id="demo" class="collapse">
            <div style="width:160%;background:slategrey;margin-top:60px;margin-left:-110%;padding: 10px;color:whitesmoke;position:absolute;">
                {{ print_r($info) }}
            </div>
        </div>
    </div>

    <div class="col-md-12">

        @foreach($info as $value)
            {{ $value }}<br>
        @endforeach

    </div>

</div>