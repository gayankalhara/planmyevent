<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Http\Controllers\EmailController;
use Input;
use Validator;
use Redirect;
use Session;

// Model namespaces
use App\Models\Event_Services;
use App\Models\Event_Types;
use App\Models\Quote_Requests;
use App\Models\Requested_Services;
use App\Models\Approved_Quotes;
use App\Models\Rejected_Quotes;
use App\Models\Events;
use App\Models\Users;

class hjController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }



    /**
     * This function loads all the Event Types to the view.
     * Display the view 'request-a-quote'
     *
     * @return request-a-quote view with all Event Types in database as $eventType variable
     */
    public function LoadRequestQuote()
    {
        $user = Auth::user();

        foreach ($user as $key) {

            $name = $user->name;
            $email = $user->email;
            $phone = $user->telephone;
            $address = $user->address;
            $city = $user->city;
            $zip = $user->zip;

        }

        $fullname = explode(" ", $name);

        if(!array_key_exists ( 1 , $fullname ))
            $fullname[1] = "";

        $eventName = Event_Types::select('EventName')->get();

        return view('quote_requests/customer/request-a-quote')->with( array('eventType' => $eventName, 'fullname' => $fullname,
                                    'email' => $email,'phone' => $phone, 'address' => $address, 'city' => $city, 'zip' => $zip));

    }



    /**
     * This function loads all the Services for a selected Event Type to the view.
     *
     * @param string POST data AJAX request
     *
     * @return all the Services of a selected Event Type as $result variable
     */
    public function LoadServices()
    {
    	$event = Request::all();
    	$event = $event['event'];

    	$result = Event_Services::select('Service')->where('EventName', $event)->get();

        return $result;
    }



    /**
     * This function is used to add a quote by a customer
     *
     * @param string POST data
     *
     * @return if validation errors found redirect to same route 'request-a-quote' with validation errors and input data |
     *         else insert the quote to the database tables 'quote-requests' and 'requested-services' then return $message |
     *         catch if any error found when executing the database query and return $message
     */
    public function AddQuoteCustomer()
    {
        /*
         * Get all the existing Quote IDs from the database
         */
        $getid = Quote_Requests::select('id')->get();

        /*
         * condition used to generate the Quote ID
         * check if the collection return to the $getid variable is empty
         * if not empty get the last Quote ID from the table 'quote_requests' and increment it by 1 the assign to $id
         * else assign 1 to $id
         */
        if(!$getid->isEmpty()){

            $getid = Quote_Requests::select('id')->orderBy('id', 'desc')->first()->get();

            foreach ($getid as $key) {

                $id = ((int)$key->id) + 1;

            }

        }
        else {

            $id = 1;

        }

        $request = Request::all();

        /*
         * Laravel Validation for quote
         */
        $rules = array(
            'firstname' => 'required|alpha',
            'address' => 'required',
            'city' => 'required|alpha',
            'zip' => 'numeric',
            'email' => 'required|email',
            'phone' => 'digits:10',
            'contact' => 'required',
            'eventType' => 'required',
            'task' => 'required',
            'guests' => 'required',
            'eventdate' => 'required|date',
            'eventdays' => 'required|numeric',
            'eventtime' => 'required',
            'objective' => 'required',
            'guesttype' => 'required'
        );

        $validation = Validator::make($request, $rules);

        if($validation->fails()){

            return redirect('dashboard/request-a-quote')->withErrors($validation)->withInput();
        }

        else {
            /*
             * Customer Details
             */
            $fname = $request['firstname'];
            $lname = $request['lastname'];
            $address = $request['address'];
            $city = $request['city'];
            $zip = $request['zip'];
            $email = $request['email'];
            $phone = $request['phone'];
            $contactVia = $request['contact'];

            /*
             * Event Details
             */
            $eventType = $request['eventType'];
            $task = $request['task'];
            $taskCount = count($request['task']);
            $guests = $request['guests'];
            $eventDate = $request['eventdate'];
            $eventDays = $request['eventdays'];
            $eventTime = $request['eventtime'];
            $objective = $request['objective'];
            $guestType = implode(", ", $request['guesttype']);

            /*
             * Active User Details
             */
            $username = Auth::user()->name;
            $userID = Auth::user()->id;
            $addedDate = date('Y-m-d H:i:s');

            $eventDate = date('Y-m-d', strtotime(str_replace('-', '/', $eventDate)));

            try {
                /*
                 * Insert the new Quote to Database Table 'quote_requests'
                 */
                $quoteRequests = new Quote_Requests;

                $quoteRequests->id = $id;
                $quoteRequests->UserID = $userID;
                $quoteRequests->Username = $username;
                $quoteRequests->FirstName = $fname;
                $quoteRequests->LastName = $lname;
                $quoteRequests->Address = $address;
                $quoteRequests->City = $city;
                $quoteRequests->Zip = $zip;
                $quoteRequests->Email = $email;
                $quoteRequests->Phone = $phone;
                $quoteRequests->Contact_Via = $contactVia;
                $quoteRequests->EventType = $eventType;
                $quoteRequests->ServiceCount = $taskCount;
                $quoteRequests->Guests = $guests;
                $quoteRequests->EventDate = $eventDate;
                $quoteRequests->NoOfDays = $eventDays;
                $quoteRequests->EventTime = $eventTime;
                $quoteRequests->Objective = $objective;
                $quoteRequests->EventFor = $guestType;
                $quoteRequests->AddedDateTime = $addedDate;
                $quoteRequests->Status = 'Pending';

                $quoteRequests->save();

                /*
                 * Insert the newly requested Services to Database Table 'requested_services'
                 */
                foreach ($task as $key) {

                    $requestedServices = new Requested_Services;

                    $requestedServices->QuoteID = $id;
                    $requestedServices->Service = $key;
                    $requestedServices->Cost = 0;

                    $requestedServices->save();

                }

                $newemail = new EmailController;

                $newemail->requestQuoteEmail($username, $email, $id);

                return redirect('dashboard/request-a-quote')->with('message', 'success');

            }

            catch (QueryException $e) {

                return redirect('dashboard/request-a-quote')->with('message', 'fail');

            }
        }

    }




    /**
     * This function displays all the quotes requests made by the customer
     *
     * @return pending, approved, rejected quote requests as $pending, $approved, $rejected variable respectively to the view
     *         quote-requests-customer
     */
    public function ViewQuoteRequestsCustomer()
    {
        $id = Auth::user()->id;

        $user = Users::find($id);

        $pending = $user->getQuotes()->where('Status', 'Pending')->get();

        $approved = $user->getQuotes()->where('Status', 'Approved')->get();

        $rejected = $user->getQuotes()->where('Status', 'Rejected')->get();

        return view('quote_requests/customer/quote-requests-customer')->with(array('pending' => $pending, 'approved' => $approved, 'rejected' => $rejected));
    }




    /**
     * This function displays all the pending quotes requests made by the customer
     *
     * @param string POST data
     *
     * @return pending quote requests as $pending variable send to the view quote-requests-customer
     *
     */
    public function ViewPendingQuotesCustomer()
    {
        $quoteid = Request::all();

        $result = Quote_Requests::select('*')->where('id', $quoteid['id'])->get();

        $quote = Quote_Requests::find($quoteid['id']);

        $serviceList = $quote->getServices($quoteid['id'])->get();

        $services = array();

        foreach ($serviceList as $key) {
            $services[] = $key->Service;
        }

        $services = implode(', ', $services);

        return view('quote_requests/customer/pending-quotes-customer')->with(array('result' => $result, 'services' => $services));
    }




    /**
     * This function displays all the approved quotes requests made by the customer
     *
     * @param string GET data
     *
     * @return approved quote requests as $approved variable and send to the view quote-requests-customer
     *
     */
    public function ViewApprovedQuotesCustomer()
    {
        $quoteid = Request::all();

        $result = Quote_Requests::select('*')->where('id', $quoteid['id'])->get();

        $quote = Quote_Requests::find($quoteid['id']);

        $serviceList = $quote->getServices($quoteid['id'])->get();

        $services = array();

        foreach ($serviceList as $key) {
            $services[] = $key->Service;
        }

        $services = implode(', ', $services);

        return view('quote_requests/customer/approved-quotes-customer')->with(array('result' => $result, 'services' => $services));
    }





    /**
     * This function displays all the rejected quotes requests made by the customer
     *
     * @param string GET data
     *
     * @return rejected quote requests as $rejected variable send to the view quote-requests-customer
     *
     */
    public function ViewRejectedQuotesCustomer()
    {
        $quoteid = Request::all();

        $result = Quote_Requests::select('*')->where('id', $quoteid['id'])->get();

        $quote = Quote_Requests::find($quoteid['id']);

        $serviceList = $quote->getServices($quoteid['id'])->get();

        $services = array();

        foreach ($serviceList as $key) {
            $services[] = $key->Service;
        }

        $services = implode(', ', $services);

        return view('quote_requests/customer/rejected-quotes-customer')->with(array('result' => $result, 'services' => $services));
    }





    /**
     * This function displays reject message of a given Quote ID
     *
     * @param string GET data
     *
     * @return rejected message as $result to the view reject-message
     *
     */
    public function ViewRejectMessageCustomer()
    {
        $quoteid = Request::all();

        $result = Rejected_Quotes::select('*')->where('id', $quoteid['id'])->get();

        return view('quote_requests/customer/reject-message')->with('result', $result);
    }





    /**
     * This function displays the prices for each service and total cost of an approved service
     *
     * @param string POST data
     *
     * @return variables $approvedQuote, $serviceCount, $services, $cost are returned to quote-payment-details view
     *
     */
    public function QuotePaymentDetailsCustomer(){

        $id = Request::all();
        $quoteID = $id['eventid'];

        $approvedQuote = Approved_Quotes::find($quoteID);

        $requestedServices = $approvedQuote->getRequestedServices($quoteID)->get();

        $serviceCount = 0;
        $services = array();
        $cost = array();

        foreach ($requestedServices as $key) {
            $serviceCount++;
            $services[] = $key->Service;
            $cost[] = $key->Cost;
        }

        return view('quote_requests/customer/quote-payment-details')->with(array('approvedQuote' => $approvedQuote, 'serviceCount' => $serviceCount, 'services' => $services, 'cost' => $cost));
    }





    /**
     * This function displays payment success message
     *
     * @param string GET data
     *
     * @return view payment-success
     *
     */
    public function DisplayPaymentSuccess()
    {
        return view('quote_requests/customer/payment-success');
    }





    /**
     * This function displays payment success message
     *
     * @param string GET data
     *
     * @return view payment-fail
     *
     */
    public function DisplayPaymentFail()
    {
        return view('quote_requests/customer/payment-fail');
    }





    /**
     * This function displays all the Events of a customer
     *
     * @param string  POST Data
     *
     * @return view-all-events view with $events variable
     */
    public function ViewAllEventsCustomer()
    {
        $id = Auth::user()->id;

        $user = Users::find($id);

        $events = $user->getEvents()->get();

        return view('events/view-all-events')->with('events', $events);
    }





    /**
     * This function used display all the information about the requested quotes
     *
     * @param string GET Data
     *
     * @return send $pending, $approved, $rejected variables to the view
     */
    public function ViewQuoteRequestsAdmin()
    {
        $pending = Quote_Requests::select('*')->where('Status', 'Pending')->get();

        $approved = Quote_Requests::select('*')->where('Status', 'Approved')->get();

        $rejected = Quote_Requests::select('*')->where('Status', 'Rejected')->get();

        return view('quote_requests/admin/quote-requests-admin')->with(array('pending' => $pending, 'approved' => $approved, 'rejected' => $rejected));
    }





    /**
     * This function used display the pending details about a quote
     *
     * @param string  GET Data
     *
     * @return send $result, $services variables with pending details and services details to the view
     */
    public function ViewPendingQuotesAdmin()
    {
        $quoteid = Request::all();

        $result = Quote_Requests::select('*')->where('id', $quoteid['id'])->get();

        $quote = Quote_Requests::find($quoteid['id']);

        $serviceList = $quote->getServices($quoteid['id'])->get();

        $services = array();

        foreach ($serviceList as $key) {
            $services[] = $key->Service;
        }
        
        $services = implode(', ', $services);

        return view('quote_requests/admin/view-pending-quotes')->with(array('result' => $result, 'services' => $services));
    }





    /**
     * This function used display the approved details about a quote
     *
     * @param string  GET Data
     *
     * @return send $result, $services variables with approval details and services details to the view
     */
    public function ViewApprovedQuotesAdmin()
    {
        $quoteid = Request::all();

        $result = Quote_Requests::select('*')->where('id', $quoteid['id'])->get();

        $quote = Quote_Requests::find($quoteid['id']);

        $serviceList = $quote->getServices($quoteid['id'])->get();

        $services = array();

        foreach ($serviceList as $key) {
            $services[] = $key->Service;
        }

        $services = implode(', ', $services);

        return view('quote_requests/admin/view-approved-quotes')->with(array('result' => $result, 'services' => $services));
    }





    /**
     * This function used display the rejected details about a quote
     *
     * @param string  GET Data
     *
     * @return send $result, $services variables with rejection details and services details to the view
     */
    public function ViewRejectedQuotesAdmin()
    {
        $quoteid = Request::all();

        $result = Quote_Requests::select('*')->where('id', $quoteid['id'])->get();

        $quote = Quote_Requests::find($quoteid['id']);

        $serviceList = $quote->getServices($quoteid['id'])->get();

        $services = array();

        foreach ($serviceList as $key) {
            $services[] = $key->Service;
        }

        $services = implode(', ', $services);

        return view('quote_requests/admin/view-rejected-quotes')->with(array('result' => $result, 'services' => $services));
    }






    /**
     * This function used display the rejected details about a quote
     *
     * @param string  GET Data
     *
     * @return send $result variable with rejection details to the view
     */
    public function ViewRejectMessageAdmin()
    {
        $quoteid = Request::all();

        $result = Rejected_Quotes::select('*')->where('QuoteID', $quoteid['id'])->get();

        return view('quote_requests/admin/view-reject-message')->with('result', $result);
    }





    /**
     * This function used to fill the details about the approval of the quote (Quote ID, Event Type, Services)
     *
     * @param string  GET | POST Data
     *
     * @return send the data to fill the form
     */
    public function ApproveQuoteAdmin()
    {

        /*
         * used to display the success/fail message on the same page after submitting the approval
         */
        if(Session::has('result')){

            $result = Session::get('result');

            $eventID = $result['eventID'];
            $eventType = $result['eventType'];
            $serviceCount = $result['serviceCount'];
            $services = $result['services'];

            $message = $result['message'];

        }

        else {

            $id = Request::all();
            $eventID = $id['eventid'];
            $eventType = $id['eventType'];
            $serviceCount = $id['serviceCount'];
            $task = $id['task'];

            $services = array();

            $services = explode(', ', $task);

            $message = null;

        }
        
        return view('quote_requests/admin/add-quote')->with(array('eventID' => $eventID, 'eventType' => $eventType, 'serviceCount' => $serviceCount, 'services' => $services, 'message' => $message));
    }






    /**
     * This function is used to send a quote to the customer
     *
     * @param string POST data
     *
     * @return if validation errors found redirect to same route with validation errors and input data |
     *         else insert the quote to the database tables then return $message |
     *         catch if any error found when executing the database query and return $message
     */
    public function SendQuotationAdmin()
    {

        $id = Request::all();

        $task = $id['services'];
        $serviceList = array();
        $serviceList = explode(', ', $task);
        $serviceCount = $id['taskcount'];
        $quoteID = $id['eventid'];
        $eventType = $id['eventtype'];
        $subtotal = $id['subtotal'];
        $downpayment = $id['downpayment'];
        $totalpay = $id['totalpay'];
        $remarks = $id['remarks'];
        $addedDate = date('Y-m-d H:i:s');

        $cost = array();
        $serviceName = array();

        foreach( $id['cost']  as $key){
            $cost[] = $key;
        }

        foreach( $id['serviceName']  as $key){
            $serviceName[] = $key;
        }

        try{

            $approvedQuote = new Approved_Quotes;

            $approvedQuote->QuoteID = $quoteID;
            $approvedQuote->EventType = $eventType;
            $approvedQuote->SubTotal = $subtotal;
            $approvedQuote->DownPayment = $downpayment;
            $approvedQuote->TotalCost = $totalpay;
            $approvedQuote->AddedDateTime = $addedDate;
            $approvedQuote->Remarks = $remarks;

            $approvedQuote->save();

            foreach($id['serviceName'] as $key=>$value){
                Requested_Services::where('QuoteID', $quoteID)
                                    ->where('Service', $serviceName[$key])
                                    ->update(['Cost' => $cost[$key]]);
            }

            Quote_Requests::where('id', $quoteID)
                            ->update(['Status' => 'Approved']);

            $user = Quote_Requests::select('Username', 'Email')->where('id', $quoteID)->get();

            foreach ($user as $key) {
                $username = $key->Username;
                $emailuser = $key->Email;
            }

            $newemail = new EmailController;

            $newemail->quoteApprovedEmail($username, $emailuser, $quoteID);

            $result = array('eventID' => $quoteID, 'eventType' => $eventType, 'serviceCount' => $serviceCount, 'services' => $serviceList, 'message' => 'success');

            return redirect('dashboard/quote-requests/approve-quote')->with('result', $result);

        }

        catch(QueryException $e)
        {
            $result = array('eventID' => $quoteID, 'eventType' => $eventType, 'serviceCount' => $serviceCount, 'services' => $serviceList, 'message' => 'fail');

            return redirect('dashboard/quote-requests/approve-quote')->with('result', $result);
        }
    }






    /**
     * This function used to fill the details about the rejection of the quote (Quote ID, Event Type, Services)
     *
     * @param string  GET Data
     *
     * @return send the data to fill the form
     */
    public function RejectQuoteAdmin()
    {
        /*
         * used to display the success/fail message on the same page after submitting the rejection
         */
        if(Session::has('result')){

            $result = Session::get('result');

            $eventID = $result['eventID'];

            $quoteDetails = Quote_Requests::select('*')->where('id', $eventID)->get();

            $quote = Quote_Requests::find($eventID);

            $serviceList = $quote->getServices($eventID)->get();

            $services = array();

            foreach ($serviceList as $key) {
                $services[] = $key->Service;
            }

            $services = implode(', ', $services);

            $message = $result['message'];

        }

        else {

            $id = Request::all();
            $eventID = $id['id'];

            $quoteDetails = Quote_Requests::select('*')->where('id', $eventID)->get();

            $quote = Quote_Requests::find($eventID);

            $serviceList = $quote->getServices($eventID)->get();

            $services = array();

            foreach ($serviceList as $key) {
                $services[] = $key->Service;
            }

            $services = implode(', ', $services);

            $message = null;

        }

        return view('quote_requests/admin/reject-quote')->with(array('eventID' => $eventID, 'quoteDetails' => $quoteDetails, 'services' => $services, 'message' => $message));
    }





    /**
     * This function used to send the rejected details of a quote made by a customer
     *
     * @param string  POST Data
     *
     * @return success or fail message using $result variable
     */
    public function SendRejectQuoteAdmin()
    {

        $id = Request::all();

        $quoteID = $id['eventid'];
        $reason = $id['selectReason'];
        $message = $id['rejectMessage'];
        $addedDate = date('Y-m-d');

        try{
            /*
             *
             */
            $rejectedQuote = new Rejected_Quotes;

            $rejectedQuote->QuoteID = $quoteID;
            $rejectedQuote->Reason = $reason;
            $rejectedQuote->Message = $message;
            $rejectedQuote->RejectedDate = $addedDate;

            $rejectedQuote->save();

            Quote_Requests::where('id', $quoteID)
                ->update(['Status' => 'Rejected']);

            $result = array('eventID' => $quoteID, 'message' => 'success');

            $user = Quote_Requests::select('Username', 'Email')->where('id', $quoteID)->get();

            foreach ($user as $key) {
                $username = $key->Username;
                $emailuser = $key->Email;
            }

            $email = new EmailController;

            $email->quoteRejectedEmail($username, $emailuser, $quoteID, $reason, $message);

            return redirect('dashboard/quote-requests/reject-quote')->with('result', $result);

        }

        catch(QueryException $e)
        {
            $result = array('eventID' => $quoteID, 'message' => 'fail');

            return redirect('dashboard/quote-requests/reject-quote')->with('result', $result);
        }
    }






    /**
     * This function displays all the Events of customers
     *
     * @param string  POST Data
     *
     * @return all-events view with $events variable
     */
    public function ViewAllEventsAdmin()
    {
        $events = Events::select('*')->get();

        return view('events/all-events')->with('events', $events);
    }

}