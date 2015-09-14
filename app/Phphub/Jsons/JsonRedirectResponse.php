<?php namespace Phphub\Jsons;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Session\Store as SessionStore;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Contracts\MessageProviderInterface;


class JsonRedirectResponse extends JsonResponse {

    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;
    /**
     * The session store implementation.
     *
     * @var \Illuminate\Session\Store
     */
    protected $session;

    /**
     * @param  string  $path
     * @param  int    $status
     * @param  array  $headers
     */
    public function __construct($path, $status = 200, array $headers = array())
    {
        $jsonArray = array();

        if (Session::has('flash_notification.message')) {
            $jsonArray['code'] = Session::get('flash_notification.level') ? : 'info';
            $jsonArray['message'] = Session::get('flash_notification.message');
        }

        if (Session::has('result_storage.value')) {
            $key = Session::pull('result_storage.key') ? : 'result';
            $jsonArray[$key] = Session::pull('result_storage.value');
        }

        $jsonArray['redirect'] = $path;
        $jsonArray['_token'] = csrf_token();

        parent::__construct($jsonArray);
    }

    /**
     * Set the session store implementation.
     *
     * @param  \Illuminate\Session\Store  $session
     * @return void
     */
    public function setSession(SessionStore $session)
    {
        $this->session = $session;
    }

    /**
     * Set the request instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Flash an array of input to the session.
     *
     * @param  array  $input
     * @return $this
     */
    public function withInput(array $input = null)
    {
        $input = $input ?: $this->request->input();

        $this->session->flashInput($input);

        return $this;
    }

    /**
     * Flash a container of errors to the session.
     *
     * @param  \Illuminate\Support\Contracts\MessageProviderInterface|array  $provider
     * @param  string  $key
     * @return $this
     */
    public function withErrors($provider, $key = 'default')
    {
        $msgBag = $this->parseErrors($provider);
        $errorArray = array(
            'code' => 'error',
            'message' => implode(' ', $msgBag->all()),
        );

        $this->addData($errorArray);

        return $this;
    }

    /**
     * Parse the given errors into an appropriate value.
     *
     * @param  \Illuminate\Support\Contracts\MessageProviderInterface|array  $provider
     * @return \Illuminate\Support\MessageBag
     */
    protected function parseErrors($provider)
    {
        if ($provider instanceof MessageProviderInterface)
        {
            return $provider->getMessageBag();
        }

        return new MessageBag((array) $provider);
    }

    protected function addData($data = array())
    {
        $oldArray = (Array)$this->getData();
        $newArray = array_merge($data, $oldArray);
        $this->setData($newArray);

        return $this;
    }

}

