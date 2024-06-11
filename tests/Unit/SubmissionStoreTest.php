<?php

namespace Tests\Unit;

use App\Models\Submission;
use Tests\TestCase;

class SubmissionStoreTest extends TestCase
{
    private Submission $submission;

    public function setUp(): void
    {
        parent::setUp();

        $submission = new Submission([
            'name' => 'Jon Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.'
        ]);

        $this->submission = $submission;
    }

    public function test_check_stored_submission()
    {
        $this->assertEquals('john.doe@example.com', $this->submission->email);
    }
}
