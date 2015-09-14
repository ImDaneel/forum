<?php

class FavoritesController extends \BaseController
{
    public function createOrDelete($id)
    {
        $topic = Topic::find($id);

        if (Favorite::isUserFavoritedTopic(Auth::user(), $topic)) {
            Auth::user()->favoriteTopics()->detach($topic->id);
            $topic->decrement('favorite_count', 1);
        } else {
            Auth::user()->favoriteTopics()->attach($topic->id);
            $topic->increment('favorite_count', 1);
            Notification::notify('topic_favorite', Auth::user(), $topic->user, $topic);
        }
        Flash::success(lang('Operation succeeded.'));

        Session::flash('result_storage.key', 'favorite_count');
        Session::flash('result_storage.value', $topic->favorite_count);

        return Redirect::route('topics.show', $topic->id);
    }
}
