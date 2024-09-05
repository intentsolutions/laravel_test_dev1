<?php

namespace App\Services;

use App\Models\Submission;
use Illuminate\Support\Facades\Log;

class SubmissionService
{
    private string $model = Submission::class;

    public function create(string $name, string $email, string $message): Submission
    {
        return $this->model::create([
            'name' => $name,
            'email' => $email,
            'message' => $message,
        ]);
    }

    public function log(string $name, string $email): void
    {
        Log::info('Submission saved: ', [
            'name' => $name,
            'email' => $email,
        ]);
    }
}
