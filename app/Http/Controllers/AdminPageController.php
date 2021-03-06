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
use App\Models\Events;
use App\Models\users;
use DB;
use App\Models\Todo;
use Carbon\Carbon;
use Mail;
use Hash;


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
        return view('home')->with('eventCount', Events::where('UserID', Auth::User()->id)->get()->count())
                           ->with('todoCount', Todo::where('user_id', Auth::User()->id)->get()->count());
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
    public function loginUsing($usedID)
    {
        Auth::logout();
        Auth::loginUsingId($usedID);

        Session::put('user_role', Auth::User()->role);
        return redirect('dashboard')->with('todoCount', Todo::where('user_id', Auth::User()->id)->get()->count());
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
        $userDetails = users::select('*')->where('id', Auth::user()->id)
                                        ->get();

        return view('profile')->with('userDetails',$userDetails);
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
    public function SettingsSubmit(Request $request)
    {
          $input = $request -> all();
          $UserId = Auth::user()->id;
          $Name =$input['Name'];
          $Email =$input['Email'];
          $Telephone =$input['Telephone'];
          $Password =$input['password'];
          $RePassword =$input['password_confirmation'];
          
          
          //create validation array
              if($Password == ""){
                  $rules = array(
                    'Name' => 'regex:/(^[A-Za-z ]+$)+/',
                    'Email' => 'required|email',
                    'Telephone' => 'regex:/(^\(?0\d{2}\)?[\s\-]?\d{7}$)+/',
                    );
              } else{
                    $rules = array(
                    'Name' => 'regex:/(^[A-Za-z ]+$)+/',
                    'Email' => 'required|email',
                    'Telephone' => 'regex:/(^\(?0\d{2}\)?[\s\-]?\d{7}$)+/',   
                    'password'=> 'required|min:6|confirmed',  
                    );
              }

          

          // $messages = [

          //       'b_name.required' => 'please fill Broadcast Name field',
          //       'base_size.required' => 'please fill Base Size field',
          //       'base_size.integer' => 'Please insert integer',
          //       'date.required' => 'please fill Broadcast Date',
          //       'start_date.date' => 'Please insert valid start_date format',
          //       'end_date.date' => 'Please insert valid end_date format',

          //   ];

          //use validation class
          $validation = Validator::make($input, $rules);
          //if validation fails, redirect.
          if($validation->fails()){
            return redirect('dashboard/settings')->withErrors($validation)->withInput();
          }
          try 
          { 
            if($Password == ""){
                users::where('id', $UserId)->update(['name' => $Name , 'Email' => $Email , 'telephone' => $Telephone]); 
                return redirect('dashboard/settings')->with('message', 'Your settings have been updated Successfully.')->with('type', 'success')->with('title', 'Settings Saved!') ;
            }else{
                users::where('id', $UserId)->update(['name' => $Name , 'Email' => $Email , 'telephone' => $Telephone , 'password' => bcrypt($Password) ]); 
                return redirect('dashboard/settings')->with('message', 'Your settings have been updated Successfully.')->with('type', 'success')->with('title', 'Settings Saved!') ;
            }
          
        }
        catch(\Illuminate\Database\QueryException $e2)
        {
            return redirect('dashboard/settings')->with('message', 'Failed to update!')->with('type', 'error')->with('title', 'Error') ;
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
    public function RequestAQuote()
    {
        return view('request-a-quote');
    } 

    /**
     * Gettings List of Event Categories
     *
     * @return view
     */
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
       //$todolist = DB::select(DB::raw("SELECT * FROM sep.todo order by priority=0, priority asc, date_added asc"));

       $todolist = Todo::where('user_id', Auth::User()->id)
                        ->where('date_archieved', "0000-00-00 00:00:00")
                        ->where('date_deleted', "0000-00-00 00:00:00")
                        ->orderBy('priority', 'asc')
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
            'status' => "false",
            'priority' => Todo::count() + 1

        ])->todo_id;

       //

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

        $todoItem->date_completed = Carbon::now();
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

    public function todoMoveUp(Request $request){

        $todoItem = Todo::find($request->input('todoId'));

        $currentPriority = intval($todoItem->priority); 

        if(Todo::count() == intval($currentPriority) + 1){
            return "false";
        } else {
            $newPriority = intval($currentPriority) + 1;

            $todoItem2 = Todo::where('priority', $newPriority)->first();
            $todoItem2->priority = $currentPriority;
            $todoItem2->save();

            $todoItem->priority = $newPriority;
            $todoItem->save();

           return "true";
       }
    }

    public function todoMoveDown(Request $request){
        
            $todoItem = Todo::find($request->input('todoId'));

            $currentPriority = intval($todoItem->priority); 

        if(1 == intval($currentPriority)){
            return "false";
        } else {
            $newPriority = intval($currentPriority) - 1;

            $todoItem2 = Todo::where('priority', $newPriority)->first();
            $todoItem2->priority = $currentPriority;
            $todoItem2->save();

            $todoItem->priority = $newPriority;
            $todoItem->save();

           return "true";
        }
    }


    public function todoArchieve(Request $request){

       foreach (json_decode($request->input('todo')) as $todo_item)
        {
         return $todo_item['id'];
        }
    }


    public function ToDo(){
        $todoListActive = Todo::select(DB::raw("todo.*, DATE_FORMAT(todo.date_added,'%d-%m-%Y') as date1"))
                            ->where('date_deleted', '0000-00-00 00:00:00')
                            ->where('date_archieved', '0000-00-00 00:00:00')
                            ->get();

                           // return $todoListActive;

        $todoListArchieved = Todo::where('user_id', Auth::User()->id)
                            ->where('date_deleted', "!=", "0000-00-00 00:00:00")
                            ->get();

        $todoListDeleted= Todo::where('user_id', Auth::User()->id)
                            ->where('date_archieved', "!=", "0000-00-00 00:00:00")
                            ->get();

        return view('todo')->with('todoListActive', $todoListActive)
                            ->with('todoListArchieved', $todoListArchieved)
                            ->with('todoListDeleted', $todoListDeleted);
    }

    public function todoEmail(Request $request){

        if($request->input('emailMe') == "on"){

            $todoList1 = Todo::where('user_id', Auth::User()->id)
                            ->where('date_deleted', "0000-00-00 00:00:00")
                            ->where('date_archieved', "0000-00-00 00:00:00")
                            ->get();

            $mailData = [
               'todoList' => $todoList1
            ];



            $userEmail = Auth::User()->email;

            Mail::send('emails.todolist', $mailData, function($message) use ($userEmail) {
                $message->to($userEmail)
                    ->subject('Your Todo List Digest');
            });
        }
        

       return dd($request->input());
    }
}