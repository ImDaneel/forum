<?php namespace Phphub\Facades;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Request;

/**
 * @see \Illuminate\View\Factory
 */
class View extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        if (Request::wantsJson()) {
            return new \Phphub\Jsons\JsonResponse;
        } else {
            return 'view';
        }
    }

}
