<?php namespace Phphub\Jsons;

use Illuminate\Routing\Redirector;

class JsonRedirector extends Redirector {

    /**
     * Create a new json redirect response.
     *
     * @param  string  $path
     * @param  int     $status
     * @param  array   $headers
     * @return \Phphub\Jsons\JsonRedirectResponse
     */
    protected function createRedirect($path, $status, $headers)
    {
        $redirect = new JsonRedirectResponse($path, $status, $headers);

        if (isset($this->session))
        {
            $redirect->setSession($this->session);
        }

        $redirect->setRequest($this->generator->getRequest());

        return $redirect;
    }

}
