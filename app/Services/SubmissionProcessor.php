<?php

namespace App\Services;

use App\Events\SubmissionSaved;
use App\Models\Submission;

class SubmissionProcessor
{
    public function save(array $submission): void
    {
        $createdSubmission = Submission::create($submission);

        SubmissionSaved::dispatch($createdSubmission);
    }

}