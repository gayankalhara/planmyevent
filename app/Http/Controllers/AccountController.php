<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
  public function resendEmail() {
    // Getting all post data
    if(Request::ajax()) {
      $data = Input::all();
      print_r($data);die;
    }
}
