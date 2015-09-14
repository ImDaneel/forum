<?php namespace Phphub\jsons;

class TopicsIndex extends AbstractJsonContent {

    public function get()
    {
        $result = array();

        if (isset($this->data['node'])) {
            $result['current_node'] = $this->data['node']->name;
        }

        $result['topics'] = AbstractJsonContent::factory('topics.partials.topics', $this->data['topics'])->get();

        if (isset($this->data['nodes'])) {
            $result['nodes'] = AbstractJsonContent::factory('nodes.partials.list', $this->data['nodes'])->get();
        }

        return $result;
    }

}
