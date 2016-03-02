<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Input;
use Validator;
use Redirect;
use DB;

class hjController extends Controller
{
	//--------------------------------------------Constructor----------------------------------------------------------------
    public function __construct()
    {
      $this->middleware('auth');
    }


//-----------------------------------------------------------------------------------------------------------------------
    public function RequestAQuoteLoad()
    {
        $eventType = DB::table('event_types')->distinct()->select('EventName')->get();

        return view('request-a-quote')->with('eventType', $eventType);
    }

    public function QuoteRequestsAdmin()
    {
        $result = DB::table('quote_requests')->select('*')->get();
        return view('quote-requests')->with('result', $result);
    }

    public function RequestAQuoteGetTask()
    {
    	$event = Request::all();
    	$event = $event['event'];

    	$result = DB::table('event_types')->select('Task')->where('EventName', $event)->get();

        return $result;
    }

    public function RequestAQuoteAddQuote()
    {

        $getid = DB::select('select id from quote_requests order by id desc limit 1');

        foreach ($getid as $key) {
            if($key->id == null)
                 $id = 1;
            else
                $id = ((int)$key->id) + 1;
        }
        

        $request = Request::all();
        $fname = $request['firstname'];
        $lname = $request['lastname'];
        $address = $request['address'];
        $lname = $request['lastname'];
        $city = $request['city'];
        $zip = $request['zip'];
        $email = $request['email'];
        $phone = $request['phone'];
        $contactVia = $request['contact'];
        $eventType = $request['eventType'];
        $task = $request['task'];
        $taskCount = count($request['task']);
        $guests = $request['guests'];
        $eventDate = $request['eventdate'];
        $eventDays = $request['eventdays'];
        $eventTime = $request['eventtime'];
        $objective = $request['objective'];
        $guestType = implode(", ", $request['guesttype']);
        $username = Auth::user()->name;

        $eventDate = date('Y-m-d', strtotime(str_replace('-', '/', $eventDate)));
        $addedDate = date('Y-m-d H:i:s');

        try{
            DB::table('quote_requests')->insert([['id' => $id,
                                                'Username' => $username,
                                                'FirstName' => $fname,
                                                'LastName' => $lname,
                                                'Address' => $address,
                                                'City' => $city,
                                                'Zip' => $zip,
                                                'Email' => $email,
                                                'Phone' => $phone,
                                                'Contact_Via' => $contactVia,
                                                'EventType' => $eventType,
                                                //'Task' => $task,
                                                'TaskCount' => $taskCount,
                                                'Guests' => $guests,
                                                'EventDate' => $eventDate,
                                                'NoOfDays' => $eventDays,
                                                'EventTime' => $eventTime,
                                                'Objective' => $objective,
                                                'EventFor' => $guestType,
                                                'AddedDateTime' => $addedDate,
                                                'Status' => 'Pending']]);

            foreach ($task as $key) {
                DB::table('requested_services')->insert([['EventID' => $id, 'Service' => $key ]]);
            }

            return redirect('request-a-quote')->with('message', 'Quote Submit Successful');

        }

        catch(\Illuminate\Database\QueryException $e)
        {
            return redirect('request-a-quote')->with('message', 'Quote Submit Failed');
        }

    }

    public function ViewQuoteRequests()
    {
        $email = Auth::user()->email;

        $result = DB::table('quote_requests')->select('*')->where('email', $email)->get();

        return view('view-quote-requests')->with('result', $result);
    }

    public function GetQuoteRequests()
    {
        $result = DB::table('quote_requests')->select('*')->get();
        return $result;
    }

    public function ViewPendingQuoteRequests()
    {
        $id = Request::all();

        $result = DB::table('quote_requests')->select('*')->where('id', $id['id'])->get();

        $serviceList = DB::table('quote_requests')->join('requested_services', 'quote_requests.id', '=', 'requested_services.EventID')->select('requested_services.*')->where('id', $id['id'])->get();
        
        $services = array();

        foreach ($serviceList as $key) {
            $services[] = $key->Service;
        }
        
        $services = implode(', ', $services);

        return view('view-pending-quotes')->with(array('result' => $result, 'services' => $services));
    }

    public function ApproveQuote()
    {
        $id = Request::all();

        $result = DB::table('quote_requests')->select('*')->where('id', $id['id'])->get();

        $serviceList = DB::table('quote_requests')->join('requested_services', 'quote_requests.id', '=', 'requested_services.EventID')->select('requested_services.*')->where('id', $id['id'])->get();
        
        $services = array();

        foreach ($serviceList as $key) {
            $services[] = $key->Service;
        }
        
        $services = implode(', ', $services);
        
        return view('add-quote')->with(array('result' => $result, 'services' => $services));
    }
}