<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Session\DatabaseSessionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Input;
use Validator;
use Redirect;
use Session;
use App\event_types;
use File;


use Auth;

class PageController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website.index');
       
    }

    /**
     * Show the permission denied page.
     *
     * @return \Illuminate\Http\Response
     */
    public function PermissionDenied()
    {
        return view('permission-denied');
    }

    /**
     * Show the contact us page.
     *
     * @return \Illuminate\Http\Response
     */
    public function ContactUs()
    {
        return view('website.contact');
    }



}