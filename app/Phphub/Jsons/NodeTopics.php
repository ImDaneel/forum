<?php namespace Phphub\jsons;

class NodeTopics extends AbstractJsonContent {

    public function get()
    {
        if (count($this->data)) {
            $result = array();

            foreach ($this->data as $nodeTopic) {
                $item = array(
                    'id' => $nodeTopic->id,
                    'title' => $nodeTopic->title,
                );

                $result[] = $item;
            }
        } else {
            $result = null;
        }

        return $result;
    }

}
