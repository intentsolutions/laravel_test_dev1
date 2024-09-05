<?php

namespace App\Jobs;

use App\Events\SubmissionSaved;
use App\Services\SubmissionService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle(SubmissionService $submissionService): void
    {
        $submission = $submissionService->create(
            $this->data['name'],
            $this->data['email'],
            $this->data['message']);

        event(new SubmissionSaved($submission));
    }
}
