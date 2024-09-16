<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\FixPricesUpdated;
use App\Listeners\DivideFixPricesListener;
use App\Events\RincianJasaCreated;
use App\Listeners\UpdateJasaPrice;
use App\Events\TransactionCreated;
use App\Listeners\GenerateTermins;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        FixPricesUpdated::class => [
            DivideFixPricesListener::class,
        ],

        RincianJasaCreated::class => [
            UpdateJasaPrice::class,
        ],

        TransactionCreated::class => [
            GenerateTermins::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
