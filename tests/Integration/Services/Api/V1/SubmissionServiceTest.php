<?php

namespace Tests\Integration\Services\Api\V1;

use App\Jobs\ProcessSubmission;
use App\Services\Api\V1\SubmissionService;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class SubmissionServiceTest extends TestCase
{
    public function testDispatchSubmission()
    {
        Queue::fake();

        $service = new SubmissionService();

        $submissionData = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.'
        ];

        $service->store($submissionData);

        Queue::assertPushed(ProcessSubmission::class, function ($job) use ($submissionData) {
            return $job->data === $submissionData;
        });
    }
}
