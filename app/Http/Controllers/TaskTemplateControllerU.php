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

class TaskTemplateControllerU extends Controller
{

//--------------------------------------------Constructor----------------------------------------------------------------
    public function __construct()
    {
      $this->middleware('auth');
    }

//-----------------------------------------------------------------------------------------------------------------------



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
}