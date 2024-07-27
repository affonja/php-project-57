<?php

namespace App\Providers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Policies\TaskPolicy;
use App\Policies\TaskStatusPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Task::class => TaskPolicy::class,
        TaskStatus::class => TaskStatusPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
