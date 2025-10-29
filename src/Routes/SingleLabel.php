<?php

namespace Tualo\Office\Dako\Routes;

use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;
use Tualo\Office\Dako\SingleLabel as DSingleLabel;


class SingleLabel extends \Tualo\Office\Basic\RouteWrapper
{
    public static function register()
    {

        BasicRoute::add('/dako/singleLabel/', function ($matches) {
            App::contenttype('application/json');
            try {

                DSingleLabel::init();
                App::result('singlelabel', DSingleLabel::singleLabel($_REQUEST));
            } catch (\Exception $e) {
                App::result('msg', $e->getMessage());
                App::result('success', true);
            }
        }, array('post'), true);
    }
}
