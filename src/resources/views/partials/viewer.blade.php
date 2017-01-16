<div class="row">
    <div class="col-md-12">
        ServerName: {{ $info['virtualserver_name'] }}<br>
        Clients Online: {{ $info['virtualserver_clientsonline'] }}

        <hr>
            {{ print $viewer }}
        <br>

    </div>

</div>