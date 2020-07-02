<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Modules\Asp\Events\AspClientEvent'=>[
            'App\Modules\Asp\Listeners\AspClientListener'
        ],
        'App\Modules\Asp\Events\AspPolicyEvent'=>[
            'App\Modules\Asp\Listeners\AspPolicyListener'
        ],
        'App\Modules\Asp\Events\HireClientEvent'=>[
            'App\Modules\Asp\Listeners\HireClientListener'
        ],
        'App\Modules\Asp\Events\WorksetClientEvent'=>[
            'App\Modules\Asp\Listeners\WorkSetClientListener'
        ],
        

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
