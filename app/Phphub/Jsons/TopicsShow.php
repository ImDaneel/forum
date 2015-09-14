<?php namespace Phphub\jsons;

class TopicsShow extends AbstractJsonContent {

    public function get()
    {
        $result = array();

        $result['topic'] = AbstractJsonContent::factory('topics.partials.content', $this->data['topic'])->get();
        $result['topic']['body'] = $this->data['topic']->body;

        $result['replies'] = AbstractJsonContent::factory('topics.partials.replies', $this->data['replies'])->get();

        if (isset($this->data['nodeTopics']) && count($this->data['nodeTopics'])) {
            $result['nodeTopics'] = AbstractJsonContent::factory('NodeTopics', $this->data['nodeTopics'])->get();
        }

        return $result;
    }

}
