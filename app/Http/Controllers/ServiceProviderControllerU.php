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

class ServiceProviderControllerU extends Controller
{

//--------------------------------------------Constructor----------------------------------------------------------------
    public function __construct()
    {
      $this->middleware('auth');
    }
//-----------------------------------------------------------------------------------------------------------------------



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



//------------------------------- Edit  Service Provider Load -------------------------------------------------------------------------
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
          
          return view('serviceproviders.service-providers')->with('result',$result);
          return($input);
      }

//-----------------------------------------------------------------------------------------------------------------------------------------





//  -------------------------------- Edit  Service Provider Submit ---------------------------------------------------------------
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
//----------------------------------------------------------------------------------------------------------------------------------------------





//------------------------------------- Check Company Name and Service Availability ------------------------------------------------------------
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

}