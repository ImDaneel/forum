<?php namespace Phphub\jsons;

class TopicsPartialsContent extends AbstractJsonContent {

    public function get()
    {
        if (! empty($this->data)) {
            $result = array();
            $result['id'] = $this->data->id;
            $result['title'] = $this->data->title;
            $result['user_id'] = $this->data->user_id;
            $result['user_name'] = $this->data->user->name;
            $result['user_avatar'] = $this->data->user->present()->gravatar();
            $result['node_id'] = $this->data->node_id;
            $result['node_name'] = $this->data->node->name;
            $result['is_excellent'] = $this->data->is_excellent;
            $result['reply_count'] = $this->data->reply_count;
            $result['view_count'] = $this->data->view_count;
            $result['favorite_count'] = $this->data->favorite_count;
            $result['vote_count'] = $this->data->vote_count;
            $result['created_at'] = $this->data->created_at;
            $result['updated_at'] = $this->data->updated_at;
            $result['last_reply_user_id'] = $this->data->last_reply_user_id;
            $result['last_reply_user_name'] = $this->data->last_reply_user ? $this->data->last_reply_user->name : null;
        } else {
            $result = null;
        }

        return $result;
    }

}
