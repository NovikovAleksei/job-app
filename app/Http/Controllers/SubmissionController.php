<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubmissionRequest;
use App\Jobs\StoreSubmission;
use Illuminate\Http\RedirectResponse;

class SubmissionController extends Controller
{
    public function store(StoreSubmissionRequest $request): RedirectResponse
    {
        StoreSubmission::dispatch($request->validated())
            ->delay(now()->addSeconds(10));

        return redirect('/submissions');
    }
}
