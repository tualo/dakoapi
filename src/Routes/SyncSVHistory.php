<?php

namespace Tualo\Office\Dako\Routes;

use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;
use Tualo\Office\Dako\SyncSVHistory as DSyncSVHistory;


class SyncSVHistory extends \Tualo\Office\Basic\RouteWrapper
{
    public static function register()
    {
        BasicRoute::add('/dako/syncsvhistory', function ($matches) {
            App::contenttype('application/json');
            DSyncSVHistory::syncSVHistory();
        }, ['get'], true);
    }
}
