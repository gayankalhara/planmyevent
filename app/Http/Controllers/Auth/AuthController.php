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
use Mail;

use Illuminate\Support\Facades\Hash;

use App\Notifications;
use Vinkla\Pusher\Facades\Pusher;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users.
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard' ;

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

        return redirect()->action('AdminPageController@Dashboard');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        Session::put('user_role', 'customer');

        $newNotification = new Notifications();

        $title = "New user registered!";
        $message = $data['name'] . ' just registered using email ' . $data['email'] . '.';
        $icon = "fa-user";
        $link = 'dashboard/users';
        $for = "admin";

        $newNotification->title = $title;
        $newNotification->body = $message;
        $newNotification->icon = $icon;
        $newNotification->link = $link;
        $newNotification->for = $for;
        $newNotification->readStatus = '0';
        $newNotification->save();

        Pusher::trigger('notifications', 'success_notification', ['message' => $message, 'icon' => $icon, 'link' => $link, 'title' => $title, 'for' => $for]);

        // Send welcome email to the customer
        Mail::send('emails.register-success', [], function($message) use ($data) {
            $message->to($data['email'])
                ->subject('Welcome to PlanMyEvent.me');
        });

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => 'customer',
        ]);

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

        } else {
        
            Session::put('user_role', 'customer');
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

            $newNotification = new Notifications();
            
            $title = "New user registered!";
            $message = $user->name . ' just registered using ' . $providerName . '.';
            $icon = "fa-user";
            $link = 'dashboard/users';
            $for = "admin";

            $newNotification->title = $title;
            $newNotification->body = $message;
            $newNotification->icon = $icon;
            $newNotification->link = $link;
            $newNotification->for = $for;
            $newNotification->readStatus = '0';
            $newNotification->save();

            Pusher::trigger('notifications', 'success_notification', ['message' => $message, 'icon' => $icon, 'link' => $link, 'title' => $title, 'for' => $for]);

            //Send Welcome Email
            Mail::send('emails.register-success-social', $mailData, function($message) use ($user) {
                $message->to($user->email)
                    ->subject('Welcome to PlanMyEvent.me');
            });

            return User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => bcrypt($pwd),
                'provider_id' => $user->id,
                'avatar' => $user->avatar,
                'provider' => $provider,
                'provider_id' => $user->id,
                'role' => 'customer',
            ]);
        }
    }

}
