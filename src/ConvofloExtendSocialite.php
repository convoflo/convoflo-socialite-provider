<?php

namespace Convoflo\SocialiteProvider;

use SocialiteProviders\Manager\SocialiteWasCalled;


class ConvofloExtendSocialite
{
    /**
     * Register the provider.
     *
     * @param SocialiteWasCalled $socialiteWasCalled
     * @return void
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled): void
    {
        $socialiteWasCalled->extendSocialite('convoflo', Provider::class);
    }
}
