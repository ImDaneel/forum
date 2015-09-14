<?php namespace Phphub\Jsons;

use Illuminate\Support\Facades\Response;

class JsonResponse {

    public function make($view, $data = array(), $mergeData = array())
    {
        $data = array_merge($mergeData, AbstractJsonContent::parseData($data));
        $content = AbstractJsonContent::factory($view, $data);

        $jsonArray = $content->get();
        $jsonArray = $jsonArray ? : $data;
        $jsonArray['_token'] = csrf_token();

        return Response::json($jsonArray);
    }

    /**
     * Add a piece of shared data to the environment.
     *
     * @param  string  $key
     * @param  mixed   $value
     * @return void
     */
    public function share($key, $value = null)
    {
    }

}
