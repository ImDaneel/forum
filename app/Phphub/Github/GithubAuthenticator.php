<?php namespace Phphub\Github;

use Phphub\Listeners\GithubAuthenticatorListener;
use User;
use \Config;

/**
* This class can call the following methods on the listener object:
*
* userFound($user)
* userIsBanned($user)
* userNotFound($githubData)
*/
class GithubAuthenticator
{
    protected $userModel;

    public function __construct(User $userModel, GithubUserDataReader $reader)
    {
        $this->userModel = $userModel;
        $this->reader = $reader;
    }

    public function authByCode(GithubAuthenticatorListener $listener, $data)
    {
        if ($data['code'] == md5($data['name'] . Config::get('app.key', ""))) {
            $githubId = array('github_id' => $data['id']);
            $user = $this->userModel->firstOrCreate($githubId);

            return $this->loginUser($listener, $user, null);
        }

        return $listener->userNotFound(null);
    }

    public function authByName(GithubAuthenticatorListener $listener, $data)
    {
        $user = $this->userModel->getByNameAndPassword($data['name'], md5($data['password']));

        if ($user) {
            return $this->loginUser($listener, $user, NULL);
        }

        return $listener->userNotFound(NULL);
    }

    private function loginUser($listener, $user, $githubData)
    {
        if ($user->is_banned) {
            return $listener->userIsBanned($user);
        }

        return $listener->userFound($user);
    }
}
