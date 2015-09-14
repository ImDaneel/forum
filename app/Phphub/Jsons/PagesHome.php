<?php namespace Phphub\jsons;

class PagesHome extends AbstractJsonContent {

    public function get()
    {
        return AbstractJsonContent::factory('topics.index', $this->data)->get();
    }

}
