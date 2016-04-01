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
class ControllerU extends Controller
{

//--------------------------------------------Constructor----------------------------------------------------------------
    public function __construct()
    {
      $this->middleware('auth');
    }


//-----------------------------------------------------------------------------------------------------------------------



// ------------------------------ Load Event Categories Page ------------------------------------------------------------
/**
 * This function loads the event categories view.
 *
 *
 * @return event categories view with event_types table data
 */
    public function EventCategoriesLoad()
    {
        
        $EventQuery = Event_Types::select('*')->get();
        
      return view('event_types.categories')->with('EventTypeQuery',$EventQuery);
    }

// ----------------------------------------------------------------------------------------------------------------------




//  -------------------------------- Load Add New Event Category Page ----------------------------------------------------
/**
 * This function loads the add event category view.
 *
 *
 * @return add event categories view with services table data
 */
    public function AddEventCategoriesLoad()

    {
      $services = Services::distinct()->select('*')->groupBy('Service')->get();
      return view('event_types.add')->with('services',$services);
    }

// -----------------------------------------------------------------------------------------------------------------------




//  -------------------------------- Add New Event Category Submit --------------------------------------------------------
/**
 * This function takes care of the post method in add event category page.
 *
 * @param string        POST Data
 *
 * @return if validation error - same page | if db error event category page with error message  | no errors event categories page with success message
 */
      public function AddEventCategoriesPost()
      {


        //get form inputs
        $input = Request::all();

        //create validation input array
        $rules = array(
                'ename' => 'regex:/(^[A-Za-z ]+$)+/'
                );
        //use laravel validation class
        $validation = Validator::make($input, $rules);

        //redirect if validation fails
        if($validation->fails()){

            return redirect('dashboard/events/categories/add')->withErrors($validation)->withInput();
        }


        //get inputs to variables
        $iName = $input['ename'];
        $iTasks = array();
        $iSlug = str_replace(" ", "-", $iName);
        $iSlug = strtolower($iSlug);

        //if image upload is errorsome use default image
         if($_FILES["img"]["error"] != 0)
          {
              $filefull = 'na.png';
          }
          else
          {
             
              $fileext = Request::file('img')->getClientOriginalExtension();
              //if image is not png, redirect with error message
              if($fileext!='png')
                      return redirect('dashboard/events/categories')->with('message', 'Record Update Failed');

              //modify image name
              $filename = Request::file('img')->getClientOriginalName();
              $filefull=$iName.'.'.$fileext;
              $filefull = str_replace(' ', '_', $filefull);

              //upload the selected image to the path
              Request::file('img')->move(base_path() . '/public/images/event-icons', $filefull);
          }

          try 
          {
              //add the inputs to database
               Event_Types::insert([['EventName' => $iName, 'Icon' => $filefull , 'EventSlug' => $iSlug]]);
                foreach( $input['eservices']  as $x) 
                {
                  $iTasks[]=$x;
                  Event_Services::insert([['EventName' => $iName, 'Service' => $x ]]);
                  
                }
                return redirect('dashboard/events/categories')->with('message', 'Record Added Successfully');
          }
          catch(\Illuminate\Database\QueryException $e)
          {
                return redirect('dashboard/events/categories')->with('message', 'Record Update Failed');
          }

          
      }

//-----------------------------------------------------------------------------------------------------------------------




// ------------------------------------ Load Edit Event Categories Page ------------------------------------------------
/**
 * This function loads the edit event category page.
 *
 *
 * @return if Event Name is present in database return  edit category page , else return event category page
 */
      public function EditEventCategoriesLoad()
      {
          
          $input = Request::all();
          //if no inputs return to category page
          if ($input == null)
          {
            return redirect('dashboard/events/categories');
          }

          $ename = $_GET['EventName'];

          $result = Event_Types::select('*')->where('EventName', $ename)->get();
          //if input not found in database return to category page
          if($result=='[]')
            return redirect('dashboard/events/categories');
          
          //get inputs to variables
          $input = $input['EventName'];
          //return edit category page with event_type table data
          return view('event_types.edit')->with('EventName',$input);
          
      }


//----------------------------------------------------------------------------------------------------------------------




//----------------------------------- Edit Event Category Submit---------------------------------------------------------
/**
 * This function takes care of the post method in edit event category page.
 *
 * @param string        POST Data
 *
 * @return if db error -> event category page with error message  | no errors -> event categories page with success message
 */
public function EditEventCategoriesPost()
    {
      $input = Request::all();
      $iTasks = array();

      //if delete button is clicked, delete data from db
      if(isset($_POST['deltype']))
      {
        $deliName = $input['evnamedel'];
        Event_Types::where('EventName',$deliName)->delete();
        Event_Services::where('EventName',$deliName)->delete();
        return redirect('dashboard/events/categories')->with('message', 'Record Deleted Successfully');
      }
      //else (edit button is clicked)
      else{
        //get event name to variable
        $iName = $input['evname'];
        try
        {
          //delete exsisting event service data
          Event_Services::where('EventName',$iName)->delete();
          foreach( $input['eservices']  as $x) 
            {
              //insert new event service data
              $iTasks[]=$x;
              Event_Services::insert([['EventName' => $iName, 'Service' => $x ]]);
            }     

            //check if image upload has no errors
            if($_FILES["img"]["error"] == 0)
              {
                
                $iIcon = $input['img'];
                $fileext = Request::file('img')->getClientOriginalExtension();
                //if image is not png format. return with error message.
                if($fileext!='png')
                    return redirect('events/categories')->with('message', 'Record Update Failed');
                
                //modify image name
                $filename = Request::file('img')->getClientOriginalName();
                $iName = $input['evname'];
                $filefull=$iName.'.'.$fileext;
                $filefull = str_replace(' ', '_', $filefull);

                //upload the image to the path
                Request::file('img')->move(base_path() . '/public/images/event-icons', $filefull);
                Event_Types::where('EventName', $iName)->update(['Icon' => $filefull]);
                    
              }

                return redirect('dashboard/events/categories/')->with('message', 'Record Updated Successfully');
        }
        
        catch(\Illuminate\Database\QueryException $e)
          {
             return redirect('dashboard/events/categories/')->with('message', 'Record Update Failed '.$e->getCode());
          }
        }
      }

// -----------------------------------------------------------------------------------------------------------------------------



//---------------------------------------Check event Category Name Availability-------------------------------------------------
/**
 * This function checks if the Event Name already exsists
 *
 * @param string        POST data (category name)
 *
 * @return  0 | 1
 */


public function CheckEventCatName()
  {
        //get post data to variable
        $catname = $_POST['catname'];

        //check if the Event Name already exsists
        $result = Event_Types::select('*')->where('EventName', $catname)->get();

        //if exsists 0, else 1
        if ($result=='[]')
        echo 1;
        else 
        echo 0;    
  }



//---------------------------------------Load Service Providers Page----------------------------------------------------------------------
/**
 * This function loads the service providers page
 *
 *
 * @return  service providers page with service_providers table data
 */
    public function ServiceProviders()
    {
        $result = Service_Providers::select('*')->get() ;
        return view('serviceproviders.service-providers')->with('result',$result);
    }

//-----------------------------------------------------------------------------------------------------------------------------------------



//-----------------------------------------Load Add Service Provider Page----------------------------------------------------------------
    /**
 * This function loads the add service providers page
 *
 *
 * @return  add service providers page with services table data
 */
    public function AddServiceProviderLoad()
    {
        $result = Services::select('*')->get();
        return view('serviceproviders.add-service-provider')->with('result',$result);;
    } 
//-----------------------------------------------------------------------------------------------------------------------------------------





///------------------------------------- Check Company Name and Service Availability ---------------------------------------------------------------
/**
 * This function checks if the Company Name and Service Name combination already exsists
 *
 * @param string        POST data (company name , service name)
 *
 * @return  0 | 1
 */
    public function CheckService()
    {
        //get post data to variable
        $companyname = $_POST['companyname'];

        //check if the Event Name already exsists
        $result = Service_Providers::select('*')->where('CompanyName', $companyname)->get();

        //if exsists 0, else 1$companyname = $_POST['companyname'];
        if ($result=='[]')
          echo 1;
        else 
          echo 0;
    } 
//-----------------------------------------------------------------------------------------------------------------------------------------

    
//  -------------------------------- Add Service Provider Submit -------------------------------------------------------------------------
/**
 * This function takes care of the post method in add service provider page
 *
 * @param   Post Data
 *
 * @return  if validation error -> same page with error message | if db error -> service providers page with error message  | no errors -> service providers page with success message
 */
    public function AddServiceProviderSubmit()
      {
          $input = Request::all();

          //create the validation array
          $rules = array(
          'cname' => 'regex:/(^[A-Za-z0-9 ]+$)+/',
          'sname' => 'regex:/(^[A-Za-z ]+$)+/',
          'address' => 'regex:/[A-Za-z0-9 _.,!"]+$]*/',
          'email' => 'required|email',
          'telno' => 'digits:10' 
          );

          //use validation class
          $validation = Validator::make($input, $rules);

          //if validation fails, redirect
          if($validation->fails()){
            return redirect('dashboard/service-providers/add')->withErrors($validation)->withInput();
          }


          //get post data to variables
          $iCompanyName = $input['cname'];
          $iServiceName = $input['sname'];
          $iAddress = $input['address'];
          $iTelNo = $input['telno'];
          $iEmail = $input['email'];

          try
          {
            //insert the data to service_providers table
            Service_Providers::insert([['CompanyName' => $iCompanyName, 'Service' => $iServiceName , 'Address' => $iAddress , 'TelNo' => $iTelNo ,'Email' => $iEmail ]]);    
            return redirect('dashboard/service-providers')->with('message', 'Record Added Successfully');
          }

          catch(\Illuminate\Database\QueryException $e2)
          {
            return redirect('dashboard/service-providers')->with('message', 'Record Update Failed');
          }
      }

//-----------------------------------------------------------------------------------------------------------------------------------------

      
//  -------------------------------- Edit  Service Provider Load -------------------------------------------------------------------------
/**
 * This function loads the edit service provider page
 *
 * @param string      Company Name and Provider Name
 *
 * @return  Edit Service Provider page with service_provider table data
 */
      public function EditServiceProviderLoad()
      {
          $input = Request::all();
          
          //if no input, redirect to service providers page

          if ($input == null)
          {
            return redirect('dashboard/service-providers');
          }

          //get GET data to variables
          $cname = $_GET['CompanyName'];
          $sname = $_GET['Service'];

          //get corresponding data from service_providers table
          $result = Service_Providers::select('*')->where('CompanyName', $cname)->where('Service',$sname)->get();
          
          //if no such data exsists, redirect to service providers page
          if($result=='[]')
            return redirect('dashboard/service-providers');
          
          return view('serviceproviders.edit-provider')->with('result',$result);
          return($input);
      }

//-----------------------------------------------------------------------------------------------------------------------------------------


//  -------------------------------- Edit  Service Provider Submit -------------------------------------------------------------------------
/**
 * This function takes care of the post method in edit Service Provider page.
 *
 * @param string        POST Data
 *
 * @return if db error -> service providers page with error message  | no errors -> service providers page with success message
 */
      public function EditServiceProviderSubmit()
      {

          $input = Request::all();

          //create validation array
          $rules = array(
            'address' => 'regex:/[A-Za-z0-9 _.,!"]+$]*/',
            'email' => 'required|email',
            'telno' => 'digits:10' 
            );

          //use validation class
          $validation = Validator::make($input, $rules);

          //if validation fails, redirect.
          if($validation->fails()){
            return redirect('dashboard/service-providers/edit')->withErrors($validation)->withInput();
          }
          
          // check if delete button is clicked
          if(isset($_POST['delprov']))
          {

            $iCompanyName = $input['delcname'];
            $iServiceName = $input['delsname'];

            //delete the record from service_providers page
            Service_Providers::where('CompanyName',$iCompanyName)->where('Service',$iServiceName)->delete();
          
            return redirect('dashboard/service-providers')->with('message', 'Record Deleted Successfully');
          }
          else
          {
          
            //get post data to variables
            $iCompanyName = $input['cname'];
            $iServiceName = $input['sname'];
            $iAddress = $input['address'];
            $iTelNo = $input['telno'];
            $iEmail = $input['email'];

          try 
          {
            //update the service providers table data
            Service_Providers::where('CompanyName', $iCompanyName)->where('Service', $iServiceName)->update(['Address' => $iAddress , 'TelNo' => $iTelNo , 'Email' => $iEmail ]);    
            return redirect('dashboard/service-providers')->with('message', 'Record Updated Successfully');
          }

          catch(\Illuminate\Database\QueryException $e2)
          {
            return redirect('dashboard/service-providers')->with('message', 'Record Update Failed');
          }
        }
      }
//-----------------------------------------------------------------------------------------------------------------------------------------------



//---------------------------------------------------Load Add Task Template  page ---------------------------------------------------------------
/**
 * This function loads the Add Task Template page
 *
 * @param string      Event Category Name
 *
 * @return  Add Task Template page with event_types table data
 */
      public function TaskTemplateAddLoad()
      {

          $input = Request::all();

          //if no inputs, redirect to Task Templates page
          if ($input == null)
          {
            return redirect('dashboard/events/categories/tasks');
          }
          
          //check with db if EventName is valid
          $ename = $_GET['EventName'];
          $result = Event_Types::select('*')->where('EventName', $ename)->get();
          
          //if not valid,  redirect to Task Templates page
          if($result=='[]')
            return redirect('dashboard/events/categories/tasks');
          
          return view('tasks.add_task')->with('result',$result);
      
      }


//----------------------------------------------------------------------------------------------------------------------------------------------- 



//------------------------------------- Add Task Template Post ---------------------------------------------------------------------------------
/**
 * This function takes care of the post method in Add Task Template page.
 *
 * @param string        POST Data
 *
 * @return  if validation error -> same page with error message | if db error -> Task Template page with error message  | no errors -> Task Template page with success message
 */
      public function TaskTemplateAddPost()
      {
         $input = Request::all();
         
         //create arrays to store post data
         $iTodoList = array();
         $iDescription = array();

         //take inputs to variables
         $iName = $input['iEventName'];
         
                
        //store input data in corresponding arrays       
        foreach( $input['Task']  as $x) 
        {
            $iTodoList[] = $x;
        }     

        foreach( $input['Description']  as $y) 
        {
            $iDescription[] = $y;
        }  

        //input data to task_templates table
        try
        {
            foreach($input['Task']  as $z=>$value) 
            {
                echo $iTodoList[$z].' '.$iDescription[$z];
                Task_Templates::insert([['EventName' => $iName, 'ToDoTask' => $iTodoList[$z] , 'Description' => $iDescription[$z]]]);
            }
        }
        
        catch(\Illuminate\Database\QueryException $e)
        {
            return redirect('dashboard/events/categories/tasks')->with('message', 'Record Update Failed '.$e->getCode());
        }  

        return redirect('dashboard/events/categories/tasks')->with('message', 'Record Updated Successfully ');
         
        
      }
//----------------------------------------------------------------------------------------------------------------------------------------------- 



//------------------------------------- Task Template Page load ---------------------------------------------------------------------------------

/**
 * This function loads the Task Template Page
 *
 *
 * @return  Task Templates page with task_template page data
 */

      public function TaskTemplateLoad()
      {
            $result = Task_Templates::select('*')->groupBy('EventName')->get();
            return view('tasks.task_templates')->with('result',$result);
      }
//----------------------------------------------------------------------------------------------------------------------------------------------- 



//------------------------------------- Edit Task Template Page load ---------------------------------------------------------------------------------
/**
 * This function loads the Edit Task Template Page
 *
 * @param   EventName
 *
 * @return  Edit Task Templates page with to_do_template page data
 */
      public function TaskTemplateEditLoad()
      {
          $input = Request::all();

          //get EventName from URL
          if ($input == null)
          {
            return redirect('dashboard/events/categories/tasks');
          }
          $ename = $_GET['EventName'];
          //get corresponding event_types Data
          $result = Event_Types::select('*')->where('EventName', $ename)->get();

          //if result is empty, redirect to Task Templates Page
          if($result == '[]')
          {
            return redirect('dashboard/events/categories/tasks');
          }
          else
          {
            //get corresponding Task Template for the Event Name
            $result2 = Task_Templates::select('*')->where('EventName', $ename)->get();
            //if data is not found to given Event Name, redirect to Add Task Templates Page
            if($result2 == '[]')
            {
              return view('tasks.add_task')->with('result',$result);
            }
            else
            //else return to Edit Task Templates Page
            {
                  return view('tasks.edit_task')->with('result',$result2);
            }
          }
      }
//----------------------------------------------------------------------------------------------------------------------------------------------- 



//------------------------------------- Get Task Templates table data ---------------------------------------------------------------------------
/**
 * This function gives the Exsisting Task Template for given EventName
 *
 * @param   EventName
 *
 * @return  Edit Task Templates page with task_template table data
 */   
      public function GetTaskDetails()
      {
        $ename = $_POST['EvName'];
        $result = Task_Templates::select('ToDoTask','Description')->where('EventName', $ename)->get();
        return $result;    
      }

//----------------------------------------------------------------------------------------------------------------------------------------------- 



//------------------------------------- Edit Task Template Post --------------------------------------------------------------------------------
/**
 * This function takes care of the post method in Add Task Template page.
 *
 * @param string        POST Data
 *
 * @return  if validation error -> same page with error message | if db error -> Task Template page with error message  | no errors -> Task Template page with success message
 */
      public function TaskTemplateEditPost()
      {
        $input = Request::all();
         
         //create arrays to store post data
         $iTodoList = array();
         $iDescription = array();

         //take inputs to variables
         $iName = $input['iEventName'];
         
        //delete exsisting task_template data
        Task_Templates::where('EventName',$iName)->delete();
                
        //store input data in corresponding arrays  
        foreach( $input['Task']  as $x) 
        {
            $iTodoList[] = $x;
        }     

        foreach( $input['Description']  as $y) 
        {
            $iDescription[] = $y;
        }  

        //input data to task_templates table
        try
        {
            foreach($input['Task']  as $z=>$value) 
                {
                  echo $iTodoList[$z].' '.$iDescription[$z];
                  
                  Task_Templates::insert([['EventName' => $iName, 'ToDoTask' => $iTodoList[$z] , 'Description' => $iDescription[$z]]]);
                }
        }
        
        catch(\Illuminate\Database\QueryException $e)
        {
              return redirect('dashboard/events/categories/tasks')->with('message', 'Record Update Failed '.$e->getCode());
        }  


                
             return redirect('dashboard/events/categories/tasks')->with('message', 'Record Updated Successfully ');
      }


//-------------------------------------------------------------------------------------------------------------------------------------------------







//---------------------------------------- Services Page Load ----------------------------------------------------------------------------
/**
 * This function loads the services page
 *
 * 
 *
 * @return  services page with services table data
 */

      public function Services()
      {
          $result = Services::select('*')->get();
          return view('services.services')->with('result',$result);
      }
//--------------------------------------------------------------------------------------------------------------------------------------------



//---------------------------------------- Add Services Page Load ----------------------------------------------------------------------------
/**
 * This function loads the add services page
 *
 * 
 *
 * @return  add services page
 */
      public function AddServices()
      {
        return view('services.add-service');
      }
//--------------------------------------------------------------------------------------------------------------------------------------------



//---------------------------------------- Edit Services Page Load ----------------------------------------------------------------------------
/**
 * This function loads the edit services page
 *
 * @param   Service Name in URL
 *
 * @return  edit services page
 */
      public function EditServices()
      {
        $input = Request::all();
        if ($input == null)
          {
            return redirect('dashboard/services');
          }
        $service = $_GET['Service'];
        $services = Services::distinct()->select('Service')->where('Service',$service)->get();
        return view('services.edit-service');
      }

//--------------------------------------------------------------------------------------------------------------------------------------------



//---------------------------------------- Add Services Page Submit ----------------------------------------------------------------------------
/**
 * This function takes care of the submit on Add services Page
 *
 * @param   POST data
 *
 * @return  same page if validation fails, else services page with success message
 */


      public function AddServicesSubmit()
      {
        //get form inputs
        $input = Request::all();

        //create validation input array
        $rules = array(
                'Service' => 'regex:/(^[A-Za-z ]+$)+/',
                'Description' => 'regex:/[A-Za-z0-9 _.,!"]+$]*/'
                );
        //use laravel validation class
        $validation = Validator::make($input, $rules);

        //redirect if validation fails
        if($validation->fails())
        {

            return redirect('dashboard/services/add')->withErrors($validation)->withInput();
        }


          //get post data to variables
          
          $iServiceName = $input['Service'];
          $iDescription = $input['Description'];
          

          $iSlug = str_replace(" ", "-", $iServiceName);
          $iSlug = strtolower($iSlug);

          try
          {
            //insert the data to services table
            Services::insert([['Service' => $iServiceName, 'ServiceSlug' => $iSlug ,'Description' => $iDescription ]]);    
            return redirect('dashboard/services')->with('message', 'Record Added Successfully');
          }

          catch(\Illuminate\Database\QueryException $e2)
          {
            return redirect('dashboard/services')->with('message', 'Record Update Failed');
          }
      }
//--------------------------------------------------------------------------------------------------------------------------------------------



//---------------------------------------- Edit Services Page Submit ----------------------------------------------------------------------------
/**
 * This function takes care of the submit on Edit services Page
 *
 * @param   POST data
 *
 * @return  same page if validation fails, else services page with success message
 */


      public function EditServicesSubmit()
      {
        //get form inputs
        $input = Request::all();
        //if delete button is clicked
        if(isset($_POST['delserv']))
        {
          $delsName = $input['delsname'];
          Services::where('Service',$delsName)->delete();
          return redirect('dashboard/services')->with('message', 'Record Deleted Successfully');
        }

        else
        {
        $iServiceName = $input['Service'];
        //create validation input array
        $rules = array(
                'Service' => 'regex:/(^[A-Za-z ]+$)+/',
                'Description' => 'regex:/[A-Za-z0-9 _.,!"]+$]*/'
                );
        //use laravel validation class
        $validation = Validator::make($input, $rules);

        //redirect if validation fails
        if($validation->fails())
        {

            return redirect('dashboard/services/edit?Service='.$iServiceName)->withErrors($validation)->withInput();
        }


          //get post data to variables
          
          $iServiceName = $input['Service'];
          $iDescription = $input['Description'];

          try
          {
            //insert the data to services table
            Services::where('Service', $iServiceName)->update(['Description' => $iDescription]);
            return redirect('dashboard/services')->with('message', 'Record Updated Successfully');
          }

          catch(\Illuminate\Database\QueryException $e2)
          {
            return redirect('dashboard/services')->with('message', 'Record Update Failed');
          }
        }
      }


      public function AssignTasks()
      {
        $team = Team_Members::distinct()->select('*')->get();
        $quote = Quote_Requests::select('*')->get();
        return view('assign_task.assign-tasks')->with(array('team' => $team, 'quote' => $quote));
      }


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
          $team = Team_Members::distinct()->select('*')->get();
          
          return view('assign_task.assign')->with(array('team' => $team, 'quote' => $quote, 'tasks' => $tasks));
      }


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

            //return dd($mem);

                foreach($mem as $memb)
                {

                  $time = Carbon::now();
                  
                  Notifications::insert([['user_ID' => $memb->MemberID, 'Icon' => 'NULL'  , 'Status' => 'Unread', 'Notification' => 'New Event Tasks Assigned for event ID '.$iName, 'Time' => $time, 'Type'=>'Specific', 'Link'=>'dashboard/events/progress?EventName='.$iName ]]);
                  $em = Team_Members::select('*')->where('id',$memb->MemberID)->first();
                  //foreach($em as $email)
                  //{
                  //return dd($em->Email);
                  //  $mememail = $email->Email;
                  //}
                  Mail::send('emails.member-tasks', [], function($message) use ($em)
                  {
                        $message->to($em->Email, 'Test')
                                ->subject('Tasks Assgined for Event');
                  });
                }
         /* 
           */  
            $team = Team_Members::distinct()->select('*')->get();
        $quote = Quote_Requests::select('*')->get();
        return view('assign_task.assign-tasks')->with(array('team' => $team, 'quote' => $quote));   
        
             
      }

      public function Progress()
      {
          $input = Request::all();
          $iName = $input['EventID'];


          return view('event_progress.progress')->with('EventID', $iName);;

      }

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