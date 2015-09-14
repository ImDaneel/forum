<?php namespace Phphub\jsons;

class AuthUsernotfound extends AbstractJsonContent {

    public function get()
    {
        return array(
            'code' => 'error',
            'message' => lang('Sorry, Wrong username or password.'),
        );
    }

}
