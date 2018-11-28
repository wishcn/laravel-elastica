<?php
namespace Xxstop\LaravelElastica;

use \Illuminate\Support\Facades\Facade as BaseFacade;

class Facade extends BaseFacade
{

    /**
     * @inheritdoc
     */
    protected static function getFacadeAccessor()
    {
        return 'elastica';
    }
}