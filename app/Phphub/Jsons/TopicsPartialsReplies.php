<?php namespace Phphub\jsons;

class TopicsPartialsReplies extends AbstractJsonContent {

    public function get()
    {
        if (count($this->data)) {
            $result = array();

            foreach ($this->data as $index => $reply) {
                $item = array(
                    'id' => $reply->id,
                    'user_id' => $reply->user_id,
                    'user_name' => $reply->user->name,
                    'user_avatar' => $reply->user->present()->gravatar(), 
                    'created_at' => $reply->created_at,
                    'vote_count' => $reply->vote_count, 
                    'body' => $reply->body,
                );

                $result[] = $item;
            }
        } else {
            $result = null;
        }

        return $result;
    }

}
