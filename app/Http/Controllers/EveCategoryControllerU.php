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

class EveCategoryControllerU extends Controller
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

// ---------------------------------------------------------------------------------------------------------------------------


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
}