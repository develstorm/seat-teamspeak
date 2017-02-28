<?php

namespace ZeroServer\Teamspeak\Commands;


use Illuminate\Console\Command;
use ZeroServer\Teamspeak\Models\TeamspeakLog;

class TeamspeakLogsClear extends Command
{
    protected $signature = 'teamspeak:logs:clear';

    protected $description = 'Clearing slack logs';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        TeamspeakLog::truncate();
    }
}
