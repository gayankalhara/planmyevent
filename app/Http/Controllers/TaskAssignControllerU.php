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
use App\Models\Notifications;
use Carbon\Carbon;
use App\Models\Users;

class TaskAssignControllerU extends Controller
{

//--------------------------------------------Constructor----------------------------------------------------------------
    public function __construct()
    {
      $this->middleware('auth');
    }


//-----------------------------------------------------------------------------------------------------------------------




//----------------------------------------------------------------------------------------------------------------------------

/**
 * This function loads the All Events To Be Assigned page for Event Planner/ Team Member
 *
 *
 * @return    page with Quote Requests/Users table data 
 */
      public function AssignTasks()
      {
        $team = Users::distinct()->select('*')->where('role', 'team-member')->get();
        $quote = Quote_Requests::select('*')->get();
        return view('assign_task.assign-tasks')->with(array('team' => $team, 'quote' => $quote));
      }







//----------------------------------------------------------------------------------------------------------------------------

/**
 * This function loads the Assign Tasks page for a particular event 
 *
 *
 * @return    Assign Tasks page with Quote Requests/Users table data 
 */



      public function Assign()
      {
        




          $input = Request::all();

          //if no inputs, redirect to Task Templates page
          if ($input == null)
          {
            return redirect('dashboard/events/assign-tasks');
          }
          
          //check with db if EventName is valid
          $evid = $_GET['EventID'];
          $quote = Quote_Requests::select('*')->where('id', $evid)->get();
          
          //if not valid,  redirect to Task Templates page
          if($quote=='[]')
            return redirect('dashboard/events/assign-tasks');

          foreach($quote as $quote1)
              $evetype=$quote1->EventType;

          $tasks = Task_Templates::select('*')->where('EventName',$evetype)->get();
          $team = Users::distinct()->select('*')->where('role', 'team-member')->get();
          $alreadyassigned = Event_Tasks::select('*')->where('EventID',$evid)->get();
          return view('assign_task.assign')->with(array('team' => $team, 'quote' => $quote, 'tasks' => $tasks, 'already'=> $alreadyassigned));
      }

//----------------------------------------------------------------------------------------------------------------------------

/**
 * This function Handles the post event of the Assign Tasks page
 *
 *
 * @return   if successful All Events To Be Assigned page
 */
      public function AssignPOST()
      {
        $input = Request::all();
         
         //create arrays to store post data
         $iTaskdesc = array();
         $iTeamMem = array();
         $dbData= array();
         //take inputs to variables
         $iName = $input['EventID'];

        
                
        //store input data in corresponding arrays  
        foreach( $input['desc']  as $x) 
        {
            $iTaskdesc[] = $x;
        }     

        foreach( $input['teammember']  as $y) 
        {
            $iTeamMem[] = $y;
        }  


        foreach($input['desc']  as $z=>$value) 
            {
                  Event_Tasks::insert([['EventID' => $iName, 'MemberID' => $iTeamMem[$z] , 'Description' => $iTaskdesc[$z]]]);
            }
       
          $mem = Event_Tasks::distinct()->select('MemberID')->where('EventID',$iName)->get();
          $evedata = Quote_Requests::select('*')->where('id',$iName)->first();
            //return dd($mem);

                foreach($mem as $memb)
                {

                  $time = Carbon::now();
                  
                  //Notifications::insert([['user_ID' => $memb->MemberID, 'Icon' => 'NULL'  , 'Status' => 'Unread', 'Notification' => 'New Event Tasks Assigned for event ID '.$iName, 'Time' => $time, 'Type'=>'Specific', 'Link'=>'dashboard/events/progress?EventID='.$iName ]]);
                  $em = Users::select('*')->where('id',$memb->MemberID)->first();
                  

                  $mailData = [
                  'EventID' => $iName,
                  'MemName' => $em->Name,
                  'DueDate' => $evedata->EventDate,
                  'FirstName'=>$evedata->FirstName,
                  'LastName'=> $evedata->LastName,    
                  ];

                  Mail::send('emails.member-tasks', $mailData, function($message) use ($em)
                  {
                        $message->to($em->email, 'Test')
                                ->subject('Tasks Assgined for Event');
                  });
                }
         /* 
           */  
            $team = Users::distinct()->select('*')->where('role', 'team-member')->get();
        $quote = Quote_Requests::select('*')->get();
        return view('assign_task.assign-tasks')->with(array('team' => $team, 'quote' => $quote, 'message'=>'yes'));   
        
             
      }


//not used
      public function Notifications()
      {
        $input = Request::all();
        $uID = $input['userid'];
        Notifications::where('user_ID', $uID)->update(['Status' => 'Read']);
        $notificount = Notifications::select('*')->where('user_id',$uID)->where('Status','Unread')->count();
        return $notificount;
      }


    public function CheckNotifications()
      {
        $input = Request::all();
        $uID = $input['userid'];
        $iTime = $input['time'];
        $notif = Notifications::select('*')->where('user_id',$uID)->where('status','Unread')->where('Time','<' ,$iTime)->get();
        echo $notif;
      }
}