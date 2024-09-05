<?php

namespace App\Services\Api\V1;

use App\Jobs\ProcessSubmission;

final class SubmissionService
{
    public function store(array $submission): void
    {
        ProcessSubmission::dispatch($submission);
    }
}
