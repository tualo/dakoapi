<?php

namespace Tualo\Office\Dako\Routes;


use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;
use Tualo\Office\Dako\ProviderRoute as DProviderRoute;


class ProviderRoute extends \Tualo\Office\Basic\RouteWrapper
{
    public static function register()
    {

        BasicRoute::add('/dako/providerRoute', function ($matches) {
            DProviderRoute::init();
            App::contenttype('application/json');
            App::result('providerRoute', DProviderRoute::providerRoute());
        }, array('get', 'post'), true);
    }
}
