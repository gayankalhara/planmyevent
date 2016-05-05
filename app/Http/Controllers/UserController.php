<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Models\users;

class UserController extends Controller
{
    /**
     * Deactivates an account
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function deactivate()
    {
        users::destroy(Auth::User()->id);
        Auth::logout();

        return redirect('login')->with('message', 'Your account has been deleted successfully!')->with('type', 'success')->with('title', 'Account Deleted');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function changeEmail()
    {
        //get form inputs
        //$input = Request::all();

        //return dd($input);
        return "Test";
    }   

}
