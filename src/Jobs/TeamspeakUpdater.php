<?php

namespace ZeroServer\Teamspeak\Jobs;


use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Seat\Eveapi\Helpers\JobPayloadContainer;
use Seat\Eveapi\Models\JobTracking;
use Seat\Services\Helpers\AnalyticsContainer;
use Seat\Services\Jobs\Analytics;
use ZeroServer\Teamspeak\Jobs\TeamspeakAssKicker;
use ZeroServer\Teamspeak\Jobs\TeamspeakReceptionist;


class TeamspeakUpdater implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels, Queueable;

    protected $jobPayload;
    protected $jobTracker;
    private $workers;

    public function __construct(JobPayloadContainer $jobPayload)
    {
        $this->jobPayload = $jobPayload;
        $this->workers = [
            TeamspeakReceptionist::class,
            TeamspeakAssKicker::class
        ];
    }

    public function handle()
    {
        if (!$this->trackOrDismiss()) {
            return;
        }

        foreach ($this->workers as $worker) {
            try {
                $this->updateJobStatus([
                    'output' => 'Processing: ' . class_basename($worker),
                ]);
                (new $worker)->setUser($this->jobPayload->user)->call();
            
            } catch (Exception $e) {
                $this->reportJobError($e);
                sleep(1);
                return;
            }
        }
        $this->updateJobStatus([
            'status' => 'Done',
            'output' => null
        ]);
    }
    public function failed(Exception $exception)
    {
        logger()->error(
            'A worker error occured. The exception thrown was ' .
            $exception->getMessage() . ' in file ' . $exception->getFile() .
            ' on line ' . $exception->getLine()
        );
        $jobTracker = JobTracking::where('owner_id', $this->jobPayload->owner_id)
            ->where('api', $this->jobPayload->api)
            ->where('scope', $this->jobPayload->scope)
            ->where('status', '<>', 'Error')
            ->first();
        if ($jobTracker) {
            $output = 'Last Updater: ' . $jobTracker->output . PHP_EOL;
            $output .= PHP_EOL;
            $output .= 'Exception       : ' . get_class($exception) . PHP_EOL;
            $output .= 'Error Code      : ' . $exception->getCode() . PHP_EOL;
            $output .= 'Error Message   : ' . $exception->getMessage() . PHP_EOL;
            $output .= 'File            : ' . $exception->getFile() . PHP_EOL;
            $output .= 'Line            : ' . $exception->getLine() . PHP_EOL;
            $output .= PHP_EOL;
            $output .= 'Traceback: ' . PHP_EOL;
            $output .= $exception->getTraceAsString() . PHP_EOL;
            $this->updateJobStatus([
                'status' => 'Error',
                'output' => $output
            ]);
        }
        // Analytics. Report only the Exception class and message.
        dispatch((new Analytics((new AnalyticsContainer)
            ->set('type', 'exception')
            ->set('exd', get_class($exception) . ':' . $exception->getMessage())
            ->set('exf', 1)))
            ->onQueue('medium'));
    }
    private function trackOrDismiss()
    {
        $this->jobTracker = JobTracking::find($this->job->getJobId());
        if (!$this->jobTracker) {
            if ($this->attempts() < 10) {
                $this->release(2);
                return false;
            }
            logger()->error(
                'Error finding a JobTracker for job ' . $this->job->getJobId()
            );
            $this->delete();
            return false;
        }
        return true;
    }
    private function reportJobError(Exception $exception)
    {
        // Write an entry to the log file
        logger()->error(
            $this->jobTracker->api . '/' . $this->jobTracker->scope . ' for ' .
            $this->jobTracker->owner_id . ' failed with ' . get_class($exception) .
            ': ' . $exception->getMessage() . '. See the job tracker for more information.'
        );
        // Prepare some useful information about the error.
        $output  = 'Last Updater: ' . $this->jobTracker->output . PHP_EOL;
        $output .= PHP_EOL;
        $output .= 'Exception       : ' . get_class($exception) . PHP_EOL;
        $output .= 'Error Code      : ' . $exception->getCode() . PHP_EOL;
        $output .= 'Error Message   : ' . $exception->getMessage() . PHP_EOL;
        $output .= 'File            : ' . $exception->getFile() . PHP_EOL;
        $output .= 'Line            : ' . $exception->getLine() . PHP_EOL;
        $output .= PHP_EOL;
        $output .= 'Traceback: ' . PHP_EOL;
        $output .= $exception->getTraceAsString() . PHP_EOL;
        $this->updateJobStatus([
            'status' => 'Error',
            'output' => $output
        ]);
        // Analytics. Report only the Exception class and message.
        dispatch((new Analytics((new AnalyticsContainer)
            ->set('type', 'exception')
            ->set('exd', get_class($exception) . ':' . $exception->getMessage())
            ->set('exf', 1)))
            ->onQueue('medium'));
        return;
    }

    private function updateJobStatus(array $data)
    {
        $this->jobTracker->fill($data);
        $this->jobTracker->save();
    }
}