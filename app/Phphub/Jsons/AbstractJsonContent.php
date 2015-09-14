<?php namespace Phphub\Jsons;

use Symfony\Component\Debug\Exception\FatalErrorException;

abstract class AbstractJsonContent {

    protected $data = array();

    public function __construct($data = array())
    {
        $this->data = static::parseData($data);
    }

    public static function factory($view, $data = array())
    {
        $className = ucwords(str_replace('.', ' ', $view));
        $className = str_replace(' ', '', $className);

        if (file_exists( __DIR__ . '/' . $className . '.php')) {
            $className = __NAMESPACE__ . '\\' . $className;
            return new $className($data);
        } else {
            return new NoneJsonContent();
        }
    }

    public static function parseData($data)
    {
        return $data instanceof Arrayable ? $data->toArray() : $data;
    }

    abstract public function get();
}
