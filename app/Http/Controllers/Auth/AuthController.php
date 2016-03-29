<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;
use Socialite;
use Session;
<<<<<<< HEAD
use Mail;

use Illuminate\Support\Facades\Hash;
=======
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
<<<<<<< HEAD
    | authentication of existing users.
=======
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
<<<<<<< HEAD
    protected $redirectTo = '/dashboard' ;
=======
    protected $redirectTo = '/' ;
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
<<<<<<< HEAD
     * @param  array $data
=======
     * @param  array  $data
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
     * @return User
     */
    protected function create(array $data)
    {
        Session::put('user_role', 'customer');

<<<<<<< HEAD
        Mail::send('emails.register-success', [], function($message) use ($data) {
            $message->to($data['email'])
                ->subject('Welcome to PlanMyEvent.me');
        });

=======
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => 'customer',
        ]);
<<<<<<< HEAD

    }

=======
    }


>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
    /**
     * Redirect the user to the Provider authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider = null)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Provider.
     *
     * @return Response
     */
    public function handleProviderCallback($provider = null)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect('auth/' . $provider);
        }

        $authUser = $this->findOrCreateUser($user, $provider);

        Auth::login($authUser, true);

<<<<<<< HEAD
        return redirect()->action('AdminPageController@Dashboard');
=======
        return redirect()->action('PageController@index');
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $user
     * @return User
     */
    private function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('email', $user->email)->first();

        if ($authUser){
            Session::put('user_role', $authUser->role);
            return $authUser;
        }

        Session::put('user_role', 'customer');

<<<<<<< HEAD
        /**
         * Random Generated Password for Social Logged Users
         *
         * @var string
         */
        $pwd = str_random(8);

        $providerName = "Social Media";
        switch ($provider) {
            case 'facebook':
                $providerName = "Facebook";
                break;
            
            case 'google':
                $providerName = "Google+";
                break;

            default:
                $providerName = "Social Media";
                break;
        }

        $mailData = [
           'name' => $user->name,
           'pwd' => $pwd ,
           'provider' => $providerName,
           'email' => $user->email,
        ];

        //Send Welcome Email
        Mail::send('emails.register-success-social', $mailData, function($message) use ($user) {
            $message->to($user->email)
                ->subject('Welcome to PlanMyEvent.me');
        });

        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => bcrypt($pwd),
=======
        return User::create([
            'name' => $user->name,
            'email' => $user->email,
>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
            'provider_id' => $user->id,
            'avatar' => $user->avatar,
            'provider' => $provider,
            'provider_id' => $user->id,
            'role' => 'customer',
<<<<<<< HEAD
=======

>>>>>>> e29ccdd27609c0470752dbc32f2bca356375a512
        ]);
    }

}
