<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Session\DatabaseSessionHandler;
//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Input;
use Validator;
use Redirect;
use Session;
use App\Models\Event_Types;
use File;
use App\Models\users;
use DB;
use App\Models\Todo;
use Carbon\Carbon;

use Auth;

class AdminPageController extends Controller
{
    /**
     *  Constructor
     *
     *
     * @return void
     */
	public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * This function loads the Users page
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function Users()
    {
        $usersAdmin = users::select('*')->where('role', 'admin')
                                        ->get();

        $usersCustomer = users::select('*')->where('role', 'customer')
                                            ->get();
                                            
        $usersEventPlanner = users::select('*')->where('role', 'event-planner')
                                                ->get();

        $usersTeamMember = users::select('*')->where('role', 'team-member')
                                            ->get();

        return view('users')->with('usersAdmin',$usersAdmin)
                            ->with('usersCustomer',$usersCustomer)
                            ->with('usersEventPlanner',$usersEventPlanner)
                            ->with('usersTeamMember',$usersTeamMember);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function Questionnaire()
    {
        $event_types = event_types::all();
        return view('questionnaire', ['event_types' => $event_types]);
    } 

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function SwitchUser($role)
    {
        Session::put('user_role', $role);

        return Redirect::back();
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function SwitchUserReset()
    {
        Auth::logout();
        Auth::loginUsingId(20);

        return view('about-us');
    }   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function changeEmail()
    {
        //get form inputs
        $input = Request::all();

        return dd($input);
    }   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function XmlPost()
    {
        $xmlData = $_POST['xmlData'];
        $fileName = $_POST['fileName'];

        $bytes_written = File::put($fileName, $xmlData);

        if ($bytes_written === false)
        {
            echo 0;
        } else{
            echo 1;
        }
    }   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function Developers()
    {
        return view('developers');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function Profile()
    {
        return view('profile');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function Settings()
    {
        $userDetails = users::select('*')->where('id', Auth::user()->id)
                                        ->get();

        return view('settings')->with('userDetails',$userDetails);
    }
    /**
     * Submit function of the Users Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function SettingsSubmit()
    {
          $input = Request::all();
          $UserId = Auth::user()->id;
          $Name =$input['Name'];
          $Email =$input['Email'];
          $Telephone =$input['Telephone'];
          $Password =$input['Password'];
          $RePassword =$input['RePassword'];
          
          //create validation array
          $rules = array(
            'Name' => 'regex:/(^[A-Za-z ]+$)+/',
            'Email' => 'required|email',
            'Telephone' => 'required|digits:10',
            'Password'=> 'required|min:6',
            
            );

          //use validation class
          $validation = Validator::make($input, $rules);
          //if validation fails, redirect.
          if($validation->fails()){
            return redirect('dashboard/settings')->withErrors($validation)->withInput();
          }
          try 
          {
          users::where('id', $UserId)->update(['name' => $Name , 'Email' => $Email , 'telephone' => $Telephone , 'password' => bcrypt($Password) ]); 
          return redirect('dashboard/settings')->with('Message','Updated Successfully');   
        }
        catch(\Illuminate\Database\QueryException $e2)
        {
            return redirect('dashboard/settings')->with('Message','Update Failed');   
        }


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function ViewAllEvents()
    {
        return view('events.view-all');
    }
        
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function NewMessage()
    {
        return view('messages.new');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function Test()
    {
        return view('test');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function Inbox()
    {
        return view('messages.inbox');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function SentMessages()
    {
        return view('messages.sent');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function Calendar()
    {
        return view('calendar');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function Customers()
    {
        return view('customers');
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function AddNewUser()
    {
        return view('user-add-new');
    }   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function Reviews()
    {
        return view('reviews');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function QuoteRequests()
    {
        return view('quote-requests');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function Invoices()
    {
        return view('invoices');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function Payments()
    {
        return view('payments');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function Statistics()
    {
        return view('statistics');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function AboutUs()
    {
        return view('about-us');
    }   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function EventAdd()
    {
        return view('events.add');
    } 

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function RequestAQuote()
    {
        return view('request-a-quote');
    } 

    public function getListOfEventCategories()
    {
      $result = \DB::select('select * from event_types');
      if($result==null)
        return redirect('question-builder');
      $data = array(
        'EventName' => $input['EventName'],
        'XmlFile' => $input['XmlFile']
      );
      return view('question-builder')->with('data',$data);
    }


    public  function todoList(){
       //$todolist = DB::select(DB::raw("select todo_id as id, description as text, status as done from todo order by date_added asc"));

       $todolist = Todo::where('user_id', Auth::User()->id)
                        ->orderBy('date_added', 'asc')
                        ->get();

       return $todolist;
    }

    public function todoListAddNew(Request $request){
       $addedItem = Todo::create([
            'user_id' => Auth::user()->id,
            'date_added' => Carbon::now(),
            'description' => $request->input('todoText'),
            'date_completed' => '0000-00-00 00:00:00',
            'date_deleted' => '0000-00-00 00:00:00',
            'date_archieved' => '0000-00-00 00:00:00',
            'status' => "false"
        ])->todo_id;

       return $addedItem;
    }

    public function todoTickToggle(Request $request){
        $todoItem = Todo::find($request->input('todoId'));
        
        $status = "false";

        if($request->input('todoStatus') == "true"){
            $status = "false";
        } else {
            $status = "true";
        }

        $todoItem->status = $status;
        $todoItem->save();

       // return "Success";
       return dd($request->input());
    }

    public function todoDelete(Request $request){
        Todo::where('todo_id',$request->input('todoId'))->delete();

        return dd($request->input());
    }

    public function todoDeleteAll(){
        Todo::truncate();
        return "Success";
    }

    public function ToDo(){
        return view('todo');
    }
}