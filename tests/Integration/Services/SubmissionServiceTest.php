<?php

namespace Tests\Integration\Services;

use App\Models\Submission;
use App\Services\SubmissionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class SubmissionServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testDispatchSubmission()
    {
        Log::shouldReceive('info')
            ->once()
            ->with('Submission saved: ', [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
            ]);

        $service = new SubmissionService();
        $name = 'John Doe';
        $email = 'john.doe@example.com';

        $service->log($name, $email);
    }

    public function testCreateMethodSavesSubmission()
    {
        $name = 'John Doe';
        $email = 'john.doe@example.com';
        $message = 'This is a test message.';

        $service = new SubmissionService();

        $submission = $service->create($name, $email, $message);

        $this->assertInstanceOf(Submission::class, $submission);
        $this->assertDatabaseHas('submissions', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.'
        ]);
    }
}
