<?php namespace Phphub\jsons;

class NodesPartialsList extends AbstractJsonContent {

    public function get()
    {
        $result = array('top' => array(), 'second' => array());

        foreach ($this->data['top'] as $index => $top_node) {
            $result['top'][] = array(
                'id' => $top_node->id,
                'name' => $top_node->name,
            );

            $snodeArray = array();
            foreach ($this->data['second'][$top_node->id] as $snode) {
                $snodeArray[] = array(
                    'id' => $snode->id,
                    'name' => $snode->name,
                );
            }
            $result['second'][$top_node->id] = $snodeArray;
        }

        return $result;
    }

}
