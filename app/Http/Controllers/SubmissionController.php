<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmissionRequest;
use App\Services\Api\V1\SubmissionService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SubmissionController extends Controller
{
    public function __construct(private readonly SubmissionService $submissionService)
    {
    }

    public function store(SubmissionRequest $submission): JsonResponse
    {
        try {
            $this->submissionService->store($submission->validated());

            return response()->json([
                'message' => 'Submission is being processed.'
            ], ResponseAlias::HTTP_ACCEPTED);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => 'Failed to process submission',
                'message' => $exception->getMessage()
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
