<?php namespace Phphub\jsons;

class UsersFavorites extends AbstractJsonContent {

    public function get()
    {
        if (count($this->data['topics'])) {
            $result = array();

            foreach ($this->data['topics'] as $topic) {
                $result[] = [
                    'id' => $topic->id,
                    'title' => $topic->title,
                    'user_name' => $topic->user->name,
                    'view_count' => $topic->view_count,
                    'reply_count' => $topic->reply_count,
                ];
            }
        } else {
            $result = null;
        }

        return ['code' => 'success', 'my_favorites' => $result];
    }

}
