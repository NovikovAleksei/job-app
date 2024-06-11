<?php

namespace App\Providers;

use App\Jobs\StoreSubmission;
use App\Listeners\SendSubmissionNotification;
use App\Services\SubmissionProcessor;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        $this->app->bindMethod([StoreSubmission::class, 'handle'], function (StoreSubmission $job, Application $app) {
            return $job->handle($app->make(SubmissionProcessor::class));
        });
    }
}
