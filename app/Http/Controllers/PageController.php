<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Session\SessionServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Input;
use Validator;
use Redirect;
use Session;


use Auth;

class PageController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function Developers()
    {
        return view('developers');
    }

    public function Profile()
    {
        return view('profile');
    }

    public function Settings()
    {
        return view('settings');
    }

    public function ViewAllEvents()
    {
        return view('events.view-all');
    }
    
    public function NewMessage()
    {
        return view('messages.new');
    }

    public function Inbox()
    {
        return view('messages.inbox');
    }

    public function SentMessages()
    {
        return view('messages.sent');
    }

    public function Calendar()
    {
        return view('calendar');
    }

    public function Customers()
    {
        return view('customers');
    }

    public function TeamMembers()
    {
        return view('team-members');
    }

    public function AddNewTeamMember()
    {
        return view('team-add-new');
    }   

    public function Reviews()
    {
        return view('reviews');
    }

    public function QuoteRequests()
    {
        return view('quote-requests');
    }

    public function Invoices()
    {
        return view('invoices');
    }

    public function Payments()
    {
        return view('payments');
    }

    public function Statistics()
    {
        return view('statistics');
    }

    public function AboutUs()
    {
        return view('about-us');
    }   

    public function EventAdd()
    {
        return view('events.add');
    } 

    public function RequestAQuote()
    {
        return view('request-a-quote');
    } 

    public function SwitchUser($role)
    {
        //$value = session('key');
        //$request->session()->put('user_role', 'customer');

        // SessionHandler::create([
        //     'user_id' => Auth::user()->id,
        // ]);

        Session::put('user_id', 'test');


        return 'customer';
    }

    public function SwitchUserReset()
    {
        Auth::logout();
        Auth::loginUsingId(20);

        return view('about-us');
    }


}