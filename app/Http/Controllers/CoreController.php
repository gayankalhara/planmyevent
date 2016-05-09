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

class CoreController extends Controller
{

      protected $request;
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    

 public function __construct(Request $request)
    {
         $this->request = $request;
    }

    public function Feedback()
    {
        
    $customerId =  Auth::user()->id;
        //$customerId = $_GET['customerId']; 
        $requestedServices = "";

        try {    
            $eventsForUser = \DB::select('select * from events where userid = ?' , [$customerId]);    
               
        } catch(\Illuminate\Database\QueryException $e)
        {
            return redirect('dashboard')->with('message', 'Error occured while getting data from the database')->with('type', 'error')->with('title', 'Error');
        }

        return view('feedback', ['customerId' => $customerId, 'eventsForUser' => $eventsForUser]);
    } 




      public function AddFeedback()
    {
        //getting values of php form text boxes
        $eventname = $this->request->input('event_drop_down');
        $comment = $this->request->input('comment');
        $rating = $this->request->input('ratings');
        $customerId = $this->request->input('customerId');
    

        try {    
            \DB::insert('insert into feedbacks (eventname, customerId, rating, Comments) values (?, ?, ?, ?)',[$eventname,$customerId, $rating,$comment]);
        } catch(\Illuminate\Database\QueryException $e)
        {
            echo $e;
            //return redirect('events/categories')->with('message', 'Record Update Failed');
            return redirect('dashboard')->with('message', 'Error occured while adding the feedback.')->with('type', 'error')->with('title', 'Adding Failed!');

        }
        return redirect('dashboard')->with('message', 'Feedback Added Successfully!')->with('type', 'success')->with('title', 'Feedback Added Successfully!');
    } 



    public function ViewFeedback()
    {
        $customerId =  Auth::user()->id;

        try {    
            $allFeedBackList = \DB::select('select * from users inner join feedback  on users.id = feedback.customerId');    

        } catch(\Illuminate\Database\QueryException $e)
        {
            return redirect('dashboard')->with('message', 'Error occured while getting data from the database')->with('type', 'error')->with('title', 'Error');
        }

        return view('allfeedback', ['customerId' => $customerId, 'allFeedBackList' => $allFeedBackList]);


    }    


    public function Addcontactus()
    {
       //getting values of php form text boxes
         $name = $this->request->input('name');
        $email = $this->request->input('email');
         $phone = $this->request->input('phone');
        $services = $this->request->input('service');
       
        $subject = $this->request->input('subject');
        $message = $this->request->input('message');
        
        //return $this->request;

        try {    
           $eventCatlist = \DB::select('select * from event_types' );    
            \DB::insert('insert into contactus (name, email, phone,service,subject,message) values (?, ?, ?, ?,?,?)',[$name,$email, $phone,$services,$subject,$message]);
        } catch(\Illuminate\Database\QueryException $e)
        {
            return view('website.contact')->with('message', 'Error occured while inserting data to the database')->with('type', 'error')->with('title', 'Error')->with('eventCatlist', $eventCatlist);
        }
        return view('website.contact')->with('message', 'Message Sent Successfully!')->with('type', 'success')->with('title', 'Message Sent Successfully!')->with('eventCatlist', $eventCatlist);
    } 

    public function ViewContacts()
    {
        $customerId =  Auth::user()->id;

        try {    
            $eventCatlist = \DB::select('select * from event_types' );  
            $contactuslist = \DB::select('select * from contactus');    

        } catch(\Illuminate\Database\QueryException $e)
        {
            return view('website.contact')->with('message', 'Error occured while getting data from the database')->with('type', 'error')->with('title', 'Error')->with('eventCatlist', $eventCatlist);
        }

        return view('allcontactus', ['customerId' => $customerId, 'contactuslist' => $contactuslist])->with('eventCatlist', $eventCatlist);


    }   


    public function ContactUs()
    {
         try {    
            $eventCatlist = \DB::select('select * from event_types' );    
               
        } catch(\Illuminate\Database\QueryException $e)
        {
            return redirect('website.contact')->with('message', 'Error occured while getting data from the database')->with('type', 'error')->with('title', 'Error');
        }

        return view('website.contact')->with('eventCatlist', $eventCatlist);
        
    }
 



 



}