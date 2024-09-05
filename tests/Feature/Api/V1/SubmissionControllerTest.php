<?php

namespace Tests\Feature\Api\V1;

use App\Jobs\ProcessSubmission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class SubmissionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_submission_successful_dispatch_to_queue(): void
    {
        Queue::fake();

        $this->postJson('/api/submissions', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ])->assertStatus(202);

        Queue::assertPushed(ProcessSubmission::class, function ($job) {
            return $job->data['name'] === 'John Doe' &&
                $job->data['email'] === 'john.doe@example.com' &&
                $job->data['message'] === 'This is a test message.';
        });
    }

    public function test_submission_validation_error(): void
    {
        $response = $this->postJson('/api/submissions', [
            'name' => '',
            'email' => 'invalid-email',
            'message' => '',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'message']);
    }
}
