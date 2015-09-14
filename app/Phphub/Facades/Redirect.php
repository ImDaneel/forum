<?php namespace Phphub\Facades;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Request;

/**
 * @see \Illuminate\Routing\Redirector
 */
class Redirect extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        if (Request::wantsJson()) {
            return 'json_redirect';
        } else {
            return 'redirect';
        }
    }

}

