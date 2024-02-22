<?php

namespace App\Jobs;

use App\Models\Submission;
use Illuminate\Bus\Queueable;
use App\Events\SubmissionSaved;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SaveSubmissionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     */
    public function __construct(protected $submission)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Submission::create($this->submission);
        event(new SubmissionSaved($this->submission['name'],$this->submission['email']));
    }

    public function failed(): void
    {
        // Notifications to user or logging systems can be sent from here
        $response = [
            'error' => 'Submission processing failed',
            'status' => 422
        ];

        Log::error("Submission Error: ".json_encode($response));

    }
}
