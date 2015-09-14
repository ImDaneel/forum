<?php namespace Phphub\jsons;

class TopicsPartialsTopics extends AbstractJsonContent {

    public function get()
    {
        if (count($this->data)) {
            $result = array();

            foreach ($this->data as $topic) {
                $result[] = AbstractJsonContent::factory('TopicsPartialsContent', $topic)->get();
            }
        } else {
            $result = null;
        }

        return $result;
    }

}
