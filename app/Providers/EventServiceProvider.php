<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        'SocialiteProviders\Manager\SocialiteWasCalled' => [
            'SocialiteProviders\VKontakte\VKontakteExtendSocialite@handle',
            'SocialiteProviders\Google\GoogleExtendSocialite@handle',
        ],
        'App\Mail\ArticleWasCreated' => [
            'App\Listeners\ArticleCreate',
        ],
        'App\Mail\CategoryWasCreated' => [
            'App\Listeners\CategoryCreate',
        ],
        'App\Mail\UserRegistrationWasConfirmed' => [
            'App\Listeners\UserRegistration',
        ],
        'App\Mail\ContactFormWasSubmitted' => [
            'App\Listeners\ContactFormSubmit',
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
