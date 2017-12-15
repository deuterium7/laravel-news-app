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
        'SocialiteProviders\Manager\SocialiteWasCalled' => [
            'SocialiteProviders\VKontakte\VKontakteExtendSocialite@handle',
            'SocialiteProviders\Google\GoogleExtendSocialite@handle',
        ],
        'App\Mail\ArticleWasCreated' => [
            'App\Listeners\NotifyUserAnArticle',
        ],
        'App\Mail\CategoryWasCreated' => [
            'App\Listeners\NotifyUserACategory',
        ],
        'App\Mail\UserRegistrationWasConfirmed' => [
            'App\Listeners\NotifyUserAnRegistration',
        ],
        'App\Events\ArticleWasViewed' => [
            'App\Listeners\IncrementArticleViewCount',
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
