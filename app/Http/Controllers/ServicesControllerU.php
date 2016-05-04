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

class ServicesControllerU extends Controller
{

//--------------------------------------------Constructor----------------------------------------------------------------
    public function __construct()
    {
      $this->middleware('auth');
    }

//-----------------------------------------------------------------------------------------------------------------------



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


//--------------------------------------------------------------------------------------------------------------------------------------------



}