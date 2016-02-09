<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Input;
use Validator;
use Redirect;

class ControllerU extends Controller
{
    public function EventCategories()
    {
        return view('events.categories');
    }

    public function ServiceProviders()
    {
        return view('service-providers');
    }

    public function AddServiceProvider()
    {
        return view('add-service-provider');
    } 

    public function CheckService()
    {
        $conn = new mysqli('localhost', 'root', '', 'sep');

        //get the username
        $companyname = mysqli_real_escape_string($conn ,$_POST['companyname']);
        $servicename = mysqli_real_escape_string($conn ,$_POST['servicename']);

        //mysql query to select field username if it's equal to the username that we check '


        $result = mysqli_query($conn,'select * from services where CompanyName = "'. $companyname .'" and Service = "'.$servicename.'"');
        //if number of rows fields is bigger them 0 that means it's NOT available '
        if(mysqli_num_rows($result)>0){
            //and we send 0 to the ajax request
            return 0;
        }else{
            //else if it's not bigger then 0, then it's available '
            //and we send 1 to the ajax request
            return 1;
        }
    } 

    public function CheckUserName()
    {
        $conn = new mysqli('localhost', 'root', '', 'sep');

        //get the username
        $username = mysqli_real_escape_string($conn ,$_POST['username']);


        //mysql query to select field username if it's equal to the username that we check '

        $result = mysqli_query($conn,'select * from event_types where EventName = "'. $username .'"');

        //if number of rows fields is bigger them 0 that means it's NOT available '
        if(mysqli_num_rows($result)>0){
            //and we send 0 to the ajax request
            return 1;
        }else{
            //else if it's not bigger then 0, then it's available '
            //and we send 1 to the ajax request
            return 0;
        }        
    }


    public function editeventsubmit()
    {
         $input = Request::all();
         $iName = $input['evname'];
         $iTasks = array();
       if(isset($_POST['deltype'])){
          \DB::delete('delete from event_types where EventName = ?' , [$iName]);
          return redirect('events/categories')->with('message', 'Record Deleted Successfully');
        }
        else{
          try{
              $result = \DB::select('SELECT Icon FROM event_types where EventName = ?' , [$iName]);
              foreach($result as $etype)
                {
                  $ic = $etype->Icon;
                }
                  \DB::delete('delete from event_types where EventName = ?' , [$iName]);
                foreach( $input['eservices']  as $x) 
                {
                  $iTasks[]=$x;
                  \DB::insert('insert into event_types  (EventName, Task , Icon) values (?, ? , ?) ON DUPLICATE KEY UPDATE Task = ?',[$iName , $x, $ic , $x ]);
                }     
                //if(isset($_POST['img'])) 
                if($_FILES["img"]["error"] == 0)
                //if (!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])
                {
                    $iIcon = $input['img'];
                    $fileext = Request::file('img')->getClientOriginalExtension();
                    if($fileext!='png')
                      return redirect('events/categories')->with('message', 'Record Update Failed');
                    $filename = Request::file('img')->getClientOriginalName();
                    $filefull=$iName.'.'.$fileext;
                    $filefull = str_replace(' ', '_', $filefull);
                    Request::file('img')->move(base_path() . '/public/images/event-icons', $filefull);
                    \DB::update('update event_types set Icon = ? where EventName = ? ',[$filefull,$iName]);
                      //return($e2->getCode());
                      //return redirect('events/categories')->with('message', 'Record Update Failed '.$e2->getCode());
                }

                return redirect('events/categories')->with('message', 'Record Updated Successfully');
              }
          catch(\Illuminate\Database\QueryException $e)
          {
             return redirect('events/categories')->with('message', 'Record Update Failed '.$e->getCode());
          }
        }
      }

      public function addeventload()
      {
         $input = Request::all();
         $iName = $input['ename'];
         $iTasks = array();

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

            try 
            {
                foreach( $input['eservices']  as $x) 
                {
                  $iTasks[]=$x;
                  \DB::insert('insert into event_types (EventName, Task , Icon) values (?, ? , ?)',[$iName , $x , $filefull]);
                }
                return redirect('events/categories')->with('message', 'Record Added Successfully');
            }
            catch(\Illuminate\Database\QueryException $e)
            {
                return redirect('events/categories')->with('message', 'Record Update Failed');
            }

          }
      }

      public function editevent()
      {
          $input = Request::all();
          if ($input == null)
          {
            return redirect('events/categories');
          }
          else
          {
          $input = $input['EventName'];
          return view('events.edit')->with('EventName',$input);
          }
      }

      public function editprovider()
      {
          $input = Request::all();
          if ($input == null)
          {
            return redirect('service-providers');
          }
          $data = array(
            'CompanyName' => $input['CompanyName'],
            'Service' => $input['Service']
          );
          return view('edit-provider')->with('data',$data);
          return($input);
      }

      public function editprovidersubmit()
      {
          $input = Request::all();
         $iCompanyName = $input['cname'];
         $iServiceName = $input['sname'];
         $iAddress = $input['address'];
         $iTelNo = $input['telno'];
         $iEmail = $input['email'];
          
        if(isset($_POST['delprov']))
        {
          \DB::delete('delete from services where CompanyName = ? and  Service = ?' , [$iCompanyName , $iServiceName]);
          return redirect('service-providers')->with('message', 'Record Deleted Successfully');
        }
        else
        {
          

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

      public function addserviceproviderload()
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