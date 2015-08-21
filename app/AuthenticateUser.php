<?php

namespace App;

use App\Repositories\UserRepository;
use Illuminate\Contracts\Auth\Guard;
use Laravel\Socialite\Contracts\Factory as Socialite;

class AuthenticateUser
{

    /**
     * @var UserRepository
     */
    private $users;


    /**
     * @var Socialite
     */
    private $socialite;


    /**
     * @var Guard
     */
    private $auth;


    /**
     * @param UserRepository $users
     * @param Socialite $socialite
     * @param Guard $auth
     */
    public function __construct(UserRepository $users, Socialite $socialite, Guard $auth)
    {
        $this->users = $users;
        $this->socialite = $socialite;
        $this->auth = $auth;
    }

    /**
     * @param string $driver facebook/twitter/google+/github/etc
     * @param bool $hasCode
     * @param AuthenticateUserListener $listener
     * @return mixed
     */
    public function execute($driver, $hasCode, AuthenticateUserListener $listener)
    {
        if(!$hasCode) return $this->getAuthorizationFirst($driver);

        $user = $this->users->findByEmailOrCreate($this->getUser($driver));

        $this->auth->login($user, true);

        return $listener->userHasLoggedIn($user);
    }

    /**
     * @return mixed
     */
    private function getAuthorizationFirst($driver)
    {
        return $this->socialite->driver($driver)->redirect();
    }

    /**
     * @param $driver
     * @return array
     */
    public function getUser($driver)
    {
        $userData = $this->socialite->driver($driver)->user();
        switch ($driver) {
            case 'facebook':
                return [
                    'name'  => $userData->name,
                    'email' => $userData->email,
                    'avatar' => $userData->avatar,
                    'facebook_user_id' => $userData->id,
                ];
        }
        return [];
    }
}
