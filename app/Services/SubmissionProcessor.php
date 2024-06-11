<?php

namespace App\Services;

use App\Events\SubmissionSaved;
use App\Jobs\StoreSubmission;
use App\Models\Submission;

class SubmissionProcessor
{
    public function save(array $submission): void
    {
        $createdSubmission = Submission::create($submission);

        SubmissionSaved::dispatch($createdSubmission);
    }

    public function dispatchEvent(array $validatedData): void
    {
        StoreSubmission::dispatch($validatedData)
            ->delay(now()->addSeconds(10));
    }
}
