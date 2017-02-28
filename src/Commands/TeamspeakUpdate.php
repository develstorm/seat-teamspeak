<?php

namespace ZeroServer\Teamspeak\Commands;


use Illuminate\Console\Command;
use Seat\Eveapi\Helpers\JobPayloadContainer;
use Seat\Eveapi\Traits\JobManager;
use ZeroServer\Teamspeak\Jobs\TeamspeakUpdater;
use Seat\Web\Models\User;

class TeamspeakUpdate extends Command
{
    use JobManager;
    
    protected $signature = 'teamspeak:update';

    protected $description = 'Auto invite and kick member based on white list/teamspeak relation';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(JobPayloadContainer $job)
    {
        User::where('active', true)->chunk(10, function($users) use ($job) {

            foreach ($users as $user) {
                $job->api = 'Teamspeak';
                $job->scope = 'Update';
                $job->owner_id = $user->id;
                $job->user = $user;

                $jobId = $this->addUniqueJob(
                    TeamspeakUpdater::class, $job
                );

                $this->info('Job ' . $jobId . ' dispatched');
            }
        });
    }
}
