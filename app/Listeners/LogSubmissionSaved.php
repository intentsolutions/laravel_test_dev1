<?php

namespace App\Listeners;

use App\Events\SubmissionSaved;
use App\Services\SubmissionService;

class LogSubmissionSaved
{

    public function __construct(private readonly SubmissionService $submissionService)
    {
    }

    public function handle(SubmissionSaved $event): void
    {
        $this->submissionService->log(
            $event->submission->name,
            $event->submission->email
        );
    }
}
