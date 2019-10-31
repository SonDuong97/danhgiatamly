<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 27/12/2018
 * Time: 00:15
 */

namespace App\Http\Controllers\Auth;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;

/**
 * Class GoogleAuthController
 * @package App\Http\Controllers\Auth
 */
class GoogleAuthController extends Controller
{
    /**
     * @var
     */
    private $_providerUser;

    /**
     * @return mixed
     */
    public function getGoogleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getGoogleCallback()
    {
        try {
            $this->_providerUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect('/');
        }
        try {
            if ($user = User::where('email', $this->_providerUser->getEmail())->first()) {
                Auth::login($user);

                return Redirect::to('/');
            } else {
                $user = $this->createUser();
                Auth::login($user);

                return Redirect::to('/');
            }
        } catch (\Exception $e) {
            return Redirect::to(route('login'));
        }
    }

    /**
     * @return mixed
     */
    private function createUser()
    {
        $user = User::create([
            'name' => $this->_providerUser->getName(),
            'email' => $this->_providerUser->getEmail(),
            'password' => Hash::make($this->_providerUser->getEmail()),
        ]);

        $userRole = Role::where('name', 'user')
            ->first();

        event(new UserRegistered($user, $userRole));

        return $user;
    }
}