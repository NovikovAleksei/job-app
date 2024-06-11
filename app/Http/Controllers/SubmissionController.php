<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubmissionRequest;
use App\Services\SubmissionProcessor;
use Illuminate\Http\JsonResponse;

class SubmissionController extends Controller
{
    public function store(StoreSubmissionRequest $request, SubmissionProcessor $processor): JsonResponse
    {
        $processor->dispatchEvent($request->validated());

        return response()->json([
            'status' => 'success',
        ]);
    }
}
