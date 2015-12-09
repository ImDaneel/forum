<?php namespace Phphub\jsons;

class TopicsShow extends AbstractJsonContent {

    public function get()
    {
        $result = array('code' => 'success');

        $result['topic'] = AbstractJsonContent::factory('topics.partials.content', $this->data['topic'])->get();
        $result['topic']['body'] = $this->data['topic']->body;

        $result['replies'] = AbstractJsonContent::factory('topics.partials.replies', $this->data['replies'])->get();

        return $result;
    }

}
