<?php
//H.A.U.C. Hewagama
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Response;
use Input;
use Validator;
use Redirect;

class ControllerU extends Controller
{

//--------------------------------------------Constructor----------------------------------------------------------------
    public function __construct()
    {
      $this->middleware('auth');
    }


//-----------------------------------------------------------------------------------------------------------------------





// ------------------------------ Load Event Categories Page ------------------------------------------------------------

    public function EventCategoriesLoad()
    {
        return view('event_types.categories');
    }

// ----------------------------------------------------------------------------------------------------------------------


//  -------------------------------- Load Add New Event Category Page ----------------------------------------------------

    public function AddEventCategoriesLoad()
    {
      return view('event_types.add');
    }

// -----------------------------------------------------------------------------------------------------------------------


//  -------------------------------- Add New Event Category Submit --------------------------------------------------------

      public function AddEventCategoriesPost()
      {
         $input = Request::all();
         $iName = $input['ename'];
         $iSlug = strtolower($iName);
         $iSlug = str_replace(" ","-",$iSlug);
         $iTasks = array();
          $iSlug = str_replace(" ", "-", $iName);
          $iSlug = strtolower($iSlug);
         if($_FILES["img"]["error"] == 0)
          {
              $iIcon = $input['img'];
              $fileext = Request::file('img')->getClientOriginalExtension();
              if($fileext!='png')
                      return redirect('events/categories')->with('message', 'Record Update Failed');
              $filename = Request::file('img')->getClientOriginalName();
              $filefull=$iName.'.'.$fileext;
              $filefull = str_replace(' ', '_', $filefull);
              Request::file('img')->move(base_path() . '/public/images/event-icons', $filefull);
<<<<<<< HEAD


            try 
            {
              \DB::insert('insert into event_types (EventName , Icon , EventSlug ) values (?, ? , ?)',[$iName , $filefull , $iSlug]);
                foreach( $input['eservices']  as $x) 
                {
                  $iTasks[]=$x;
                  \DB::insert('insert into event_services (EventName , Service ) values (?, ? )',[$iName , $x]);
=======
              
            try 
            {
                \DB::insert('insert into event_types (EventName , Icon , EventSlug) values (? , ? , ?)',[$iName , $filefull , $iSlug]);
                foreach( $input['eservices']  as $x) 
                {
                  $iTasks[]=$x;
                  \DB::insert('insert into event_services (EventName, Service) values (? , ?)',[$iName , $x ]);
>>>>>>> udesh
                }
                return redirect('events/categories')->with('message', 'Record Added Successfully');
            }
            catch(\Illuminate\Database\QueryException $e)
            {
                return redirect('events/categories')->with('message', 'Record Update Failed');
            }

          }
      }

//-----------------------------------------------------------------------------------------------------------------------




// ------------------------------------ Load Edit Event Categories Page ------------------------------------------------

      public function EditEventCategoriesLoad()
      {
          $input = Request::all();
          if ($input == null)
          {
            return redirect('events/categories');
          }

          $ename = $_GET['EventName'];
          $result = \DB::select('select * from event_types where EventName = ?' , [$ename]);
          if($result==null)
            return redirect('events/categories');
          
          $input = $input['EventName'];
          return view('event_types.edit')->with('EventName',$input);
          
      }


//----------------------------------------------------------------------------------------------------------------------




//----------------------------------- Edit Event Category Submit---------------------------------------------------------

public function EditEventCategoriesPost()
    {
         $input = Request::all();
         
         
         $iTasks = array();
       if(isset($_POST['deltype'])){
        $deliName = $input['evnamedel'];
          \DB::delete('delete from event_types where EventName = ?' , [$deliName]);
          \DB::delete('delete from event_services where EventName = ?' , [$deliName]);
          return redirect('events/categories')->with('message', 'Record Deleted Successfully');
        }
        else{
          $iName = $input['evname'];
          try{
              
                \DB::delete('delete from event_services where EventName = ?' , [$iName]);
                foreach( $input['eservices']  as $x) 
                {
                  $iTasks[]=$x;
                  \DB::insert('insert into event_services  (EventName, Service ) values (?, ? ) ON DUPLICATE KEY UPDATE Service = ?',[$iName , $x , $x ]);
                }     

                if($_FILES["img"]["error"] == 0)
                {
                    $iIcon = $input['img'];
                    $fileext = Request::file('img')->getClientOriginalExtension();
                    if($fileext!='png')
                      return redirect('events/categories')->with('message', 'Record Update Failed');
                    $filename = Request::file('img')->getClientOriginalName();
                    $iName = $input['evname'];
                    $filefull=$iName.'.'.$fileext;
                    $filefull = str_replace(' ', '_', $filefull);
                    Request::file('img')->move(base_path() . '/public/images/event-icons', $filefull);
                    \DB::update('update event_types set Icon = ? where EventName = ? ',[$filefull,$iName]);
                }

                return redirect('events/categories/')->with('message', 'Record Updated Successfully');
              }
          catch(\Illuminate\Database\QueryException $e)
          {
             return redirect('events/categories/')->with('message', 'Record Update Failed '.$e->getCode());
          }
        }
      }

// -----------------------------------------------------------------------------------------------------------------------




public function CheckEventCatName()
  {
        $catname = $_POST['catname'];
        $result = \DB::select('select * from event_types where EventName = ?',[$catname]);
        if ($result==null)
        echo 1;
        else 
        echo 0;    
  }



//---------------------------------------Load Service Providers Page----------------------------------------------------------------------

    public function ServiceProviders()
    {
        return view('serviceproviders.service-providers');
    }

//-----------------------------------------------------------------------------------------------------------------------------------------



//-----------------------------------------Load Add Service Provider Page----------------------------------------------------------------
    public function AddServiceProviderLoad()
    {
        return view('serviceproviders.add-service-provider');
    } 
//-----------------------------------------------------------------------------------------------------------------------------------------


///------------------------------------- Check Company Name and Service Availability ---------------------------------------------------------------------
    public function CheckService()
    {
        $companyname = $_POST['companyname'];
        $servicename = $_POST['servicename'];
        $result = \DB::select('SELECT * FROM services where CompanyName = ? and Service = ?',[$companyname, $servicename]);
        if ($result==null)
          echo 1;
        else 
          echo 0;
    } 
//-----------------------------------------------------------------------------------------------------------------------------------------

    
//  -------------------------------- Add Service Provider Submit -------------------------------------------------------------------------

    public function AddServiceProviderSubmit()
      {
             $input = Request::all();
             $iCompanyName = $input['cname'];
             $iServiceName = $input['sname'];
             $iAddress = $input['address'];
             $iTelNo = $input['telno'];
             $iEmail = $input['email'];

             try {    
              \DB::insert('insert into services (CompanyName, Service, Address, TelNo, Email) values (?, ?, ?, ?, ?)',[$iCompanyName , $iServiceName, $iAddress , $iTelNo , $iEmail]);
              return redirect('service-providers')->with('message', 'Record Added Successfully');
              }

              catch(\Illuminate\Database\QueryException $e2){
              return redirect('service-providers')->with('message', 'Record Update Failed');
              }
      }

//-----------------------------------------------------------------------------------------------------------------------------------------

      
//  -------------------------------- Edit  Service Provider Load -------------------------------------------------------------------------
      public function EditServiceProviderLoad()
      {
          $input = Request::all();
          if ($input == null)
          {
            return redirect('service-providers');
          }
          $cname = $_GET['CompanyName'];
          $sname = $_GET['Service'];
          $result = \DB::select('select * from services where CompanyName = ? and  Service = ?' , [$cname , $sname]);
          if($result==null)
            return redirect('service-providers');
          $data = array(
            'CompanyName' => $input['CompanyName'],
            'Service' => $input['Service']
          );
          return view('serviceproviders.edit-provider')->with('data',$data);
          return($input);
      }

//-----------------------------------------------------------------------------------------------------------------------------------------


//  -------------------------------- Edit  Service Provider Submit -------------------------------------------------------------------------
      public function EditServiceProviderSubmit()
      {
          $input = Request::all();
         
          
        if(isset($_POST['delprov']))
        {
          $iCompanyName = $input['delcname'];
          $iServiceName = $input['delsname'];
          \DB::delete('delete from services where CompanyName = ? and  Service = ?' , [$iCompanyName , $iServiceName]);
          return redirect('service-providers')->with('message', 'Record Deleted Successfully');
        }
        else
        {
          
         $iCompanyName = $input['cname'];
         $iServiceName = $input['sname'];
         $iAddress = $input['address'];
         $iTelNo = $input['telno'];
         $iEmail = $input['email'];
         try {    
          \DB::update('update services set Address = ? , TelNo = ? , Email = ? where CompanyName = ? and Service = ?',[$iAddress , $iTelNo , $iEmail ,$iCompanyName,$iServiceName ]);
            return redirect('service-providers')->with('message', 'Record Updated Successfully');
          }

          catch(\Illuminate\Database\QueryException $e2)
          {
            return redirect('service-providers')->with('message', 'Record Update Failed');
          }
        }
      }
//-----------------------------------------------------------------------------------------------------------------------------------------
      

}