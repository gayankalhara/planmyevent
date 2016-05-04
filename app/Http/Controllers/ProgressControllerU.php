<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Response;
use Input;
use Validator;
use Redirect;
use Session;
use Mail;
 
//use models
use App\Models\Event_Types;
use App\Models\Event_Services;
use App\Models\Services;
use App\Models\Service_Providers;
use App\Models\Task_Templates;
use App\Models\Team_Members;
use App\Models\Quote_Requests;
use App\Models\Event_Tasks;

use Carbon\Carbon;
use App\Models\Users;

//For Notifications
use Vinkla\Pusher\Facades\Pusher;
use App\Notifications;
class ProgressControllerU extends Controller
{

//--------------------------------------------Constructor----------------------------------------------------------------
    public function __construct()
    {
      $this->middleware('auth');
    }


//----------------------------------------------------------------------------------------------------------------------------

/**
 * This function loads the Progress editng page for Event Planner/ Team Member
 *
 *
 * @return  progress edit page with Quote Requests/Event Tasks table data
 */

      public function Progress()
      {
          $input = Request::all();
          $iName = $input['EventID'];

          $user_id = \Auth::user()->id;
          $memtasks= Event_Tasks::select('*')->where('MemberID',$user_id)->where('EventID',$iName)->get();
          $evedetails = Quote_Requests::select('*')->where('id',$iName)->first();
          
          $data = array(
            'memtasks'  => $memtasks,
            'eveID'   => $iName,
            'evedetails'=>$evedetails,
            'result' => 'null'
              ); 

          return view('event_progress.progress')->with($data);

      }

//=---------------------------------------------------------------------------------------------------------------------------


//------------------------------------- Submit Event Progress Data ------------------------------------------------------------
/**
 * This function submits the changes made in event progress
 *
 * @param string        POST data (from event progress update)
 *
 * @return  if successful, 'Events Assigned To Me' page for Team Member
 */
      public function EditProgress()
      {


        $input = Request::all();
        $iName = $input['EventID'];
        $user_id = \Auth::user()->id;

         $iPercentage = array();
         $iStatus = array();
         $iTaskID = array();

 if(isset($_POST['doneprogress']))
      {
        $today = Carbon::today()->toDateString();

        $em = Quote_Requests::select('*')->where('id',$iName)->first();
        $mailData = [
                  'EventID' => $iName,
                  'EventType' => $em->EventType,
                  'DueDate' => $em->DueDate, 
                  'CompletedOn'=> $today,
                  'FirstName' => $em->UserName
                  
                  ];
                  //send email to customer
                  Mail::send('emails.event-complete', $mailData, function($message) use ($em)
                  {
                        $message->to($em->Email, 'Test') 
                                ->subject('Your Event Is Ready!');
                  });

                  //send a notification to customer
                    $newNotification = new Notifications();
                    $newNotification->title = 'Event Complete';
                    $newNotification->body = $em->EventType.' planning is complete';
                    $newNotification->icon = 'icon';
                    $newNotification->link = 'dashboard/events/progresscustomer?EventID='.$iName;
                    $newNotification->readStatus = '0';
                    $newNotification->save();

                    $message = $em->EventType.' planning is complete';
                    $icon = 'icon';
                    $link = 'dashboard/events/progresscustomer?EventID='.$iName;
                    $title = 'Event Complete';

                    Pusher::trigger('notifications', 'success_notification', ['message' => $message, 'icon' => $icon, 'link' => $icon, 'title' => $title]);





                  return redirect('dashboard/events/myevents')->with('message', 'You Completed The Event');
      }
      else
      {
        foreach( $input['percentage']  as $x) 
        {
            $iPercentage[] = $x;
        }     

        foreach( $input['status']  as $y) 
        {
            $iStatus[] = $y;
        }

        foreach( $input['taskid']  as $z) 
        {
            $iTaskID[] = $z;
        }


          foreach($input['taskid']  as $z=>$value) 
            {
               $today = Carbon::today()->toDateString();
                Event_Tasks::where('EventID', $iName)->where('id', $iTaskID[$z])->update(['Percentage' => $iPercentage[$z] , 'Status' => $iStatus[$z] , 'LastUpdated' => $today  ]);    

            }

          
          
          return redirect('dashboard/events/myevents')->with('message', 'Record Added Successfully');
      }
    }

//=---------------------------------------------------------------------------------------------------------------------------



/**
 * This function loads the 'Events Assigned To Me'  page for Event Planner/ Team Member
 *
 *
 * @return  progress 'Events Assigned To Me' page with Event Tasks table data
 */



      public function MyEvents()
      {
        $user_id = \Auth::user()->id;
        $mytasks= Event_Tasks::distinct()->select('EventID')->where('MemberID',$user_id)->get();

      
        return view('event_progress.myevents')->with('result', $mytasks);
      }
//=---------------------------------------------------------------------------------------------------------------------------





/**
 * This function loads the 'My Events in Progress'  page for Customer
 *
 *
 * @return  progress 'Events Submitted By Me' page with Event Tasks/Quote Requests table data
 */

      public function CustomerEvents()
      {
        $user_id = \Auth::user()->id;
        $iEventID = array();
        $iEventTasks = array();
        $mytasks = array();

        $myeventids= Quote_Requests::select('id')->where('UserID',$user_id)->get();

        foreach( $myeventids  as $x) 
        {
            $iEventID[] = $x->id;

        }

        foreach ($iEventID  as $y)
        {
          $mytasks[]= Event_Tasks::distinct()->select('EventID')->where('EventID', $y)->first();
         
        }

   
        return view('progress_customer.myevents')->with('result', $mytasks);
        //echo $myeventids[0]->id;
        //echo $mytasks->EventID;
      }


//=---------------------------------------------------------------------------------------------------------------------------




/**
 * This function loads the 'Events  Progress'  page for Customer
 *
 *
 * @return  progress 'Events Progress' page with Event Tasks/Quote Requests table data
 */


      public function ProgressCustomer()
      {
          $input = Request::all();
          $iName = $input['EventID'];

          $user_id = \Auth::user()->id;
          //$customereventid = Quote_Requests::select('*')->where('id',$iName)->first();
          $memtasks= Event_Tasks::select('*')->where('EventID',$iName)->get();
          $teammem =  Users::select('*')->where('role','team-member')->get();

          $evedetails = Quote_Requests::select('*')->where('id',$iName)->first();
          
          $data = array(
            'memtasks'  => $memtasks,
            'teammem' => $teammem,
            'eveID'   => $iName,
            'evedetails'=>$evedetails,
            'result' => 'null'
              ); 
         
          return view('progress_customer.progress')->with($data);
          
      }

}


