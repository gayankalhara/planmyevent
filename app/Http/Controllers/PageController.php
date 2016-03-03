<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Session\DatabaseSessionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Input;
use Validator;
use Redirect;
use Session;
use App\event_types;
use File;


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

    public function Test()
    {
        return view('test');
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

    public function Questionnaire()
    {
        $event_types = event_types::all();
        return view('questionnaire', ['event_types' => $event_types]);
    } 

    public function SwitchUser($role)
    {
        Session::put('user_role', $role);

        return redirect('/');
    }

    public function SwitchUserReset()
    {
        Auth::logout();
        Auth::loginUsingId(20);

        return view('about-us');
    }

    public function getListOfEventCategories()
    {
        // $input = Request::all();
        //   if ($input == null)
        //   {
        //     return redirect('service-providers');
        //   }

          $result = \DB::select('select * from event_types');
          if($result==null)
            return redirect('question-builder');
          $data = array(
            'EventName' => $input['EventName'],
            'XmlFile' => $input['XmlFile']
          );
          return view('question-builder')->with('data',$data);
    }

    public function XmlPost()
    {
        $xmlData = $_POST['xmlData'];
        $fileName = $_POST['fileName'];

        $bytes_written = File::put($fileName, $xmlData);

        if ($bytes_written === false)
        {
            echo 0;
        } else{
            echo 1;
        }
    }




}