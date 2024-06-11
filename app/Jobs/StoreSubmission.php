<?php

namespace App\Jobs;

use App\Services\SubmissionProcessor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class StoreSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public array $submission,
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(SubmissionProcessor $processor): void
    {
        $processor->save($this->submission);
    }

    public function failed(?Throwable $exception): void
    {
        Log::info($exception->getMessage());
    }
}
