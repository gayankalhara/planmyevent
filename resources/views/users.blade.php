{{-- Home Page --}}



@extends('master')

@section('meta')
  <meta name="csrf-token" content="{{ Session::token() }}">
@endsection

@section('header-css')
<link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/questionnaire/css/jquery-ui.min.css')}}">
  <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/questionnaire/css/demo.css')}}">
  <!-- Only include on form edit page -->
  <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/questionnaire/css/form-builder.min.css')}}">
  <!-- Only include on form render page -->
  <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/questionnaire/css/form-render.min.css')}}">

  <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/loaders.min.css')}}">

  <link href="{{asset('assets/select2/select2.css')}}" rel="stylesheet" type="text/css" />

  <link href="{{asset('assets/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="content">
  <div class="wraper container-fluid">
      <div class="row">
          <div class="col-sm-12">
              <div class="bg-picture text-center">
                  <div class="bg-picture-overlay">
                    <h3 class="text-white" style="margin-left: 20px; margin-top: 20px;">User Manager</h3>

                  </div>

              </div>
              <!--/ meta -->
          </div>
      </div>
                    
      <div class="row user-tabs">
          <div class="col-lg-6 col-md-9 col-sm-9">
              <ul class="nav nav-tabs tabs">
              <li class="active tab">
                  <a href="#admins" data-toggle="tab" aria-expanded="false" class="active"> 
                      <span class="visible-xs"><i class="fa fa-home"></i></span> 
                      <span class="hidden-xs">Admins</span> 
                  </a> 
              </li> 
              <li class="tab">
                  <a href="#customers" data-toggle="tab" aria-expanded="false"> 
                      <span class="visible-xs"><i class="fa fa-home"></i></span> 
                      <span class="hidden-xs">Customers</span> 
                  </a> 
              </li> 
              <li class="tab"> 
                  <a href="#teammembers" data-toggle="tab" aria-expanded="false"> 
                      <span class="visible-xs"><i class="fa fa-user"></i></span> 
                      <span class="hidden-xs">Team Members</span> 
                  </a> 
              </li>
              <li class="tab"> 
                  <a href="#eventplanners" data-toggle="tab" aria-expanded="false"> 
                      <span class="visible-xs"><i class="fa fa-user"></i></span> 
                      <span class="hidden-xs">Event Planners</span> 
                  </a> 
              </li> 

          <div class="indicator"></div></ul> 
          </div>
          <div class="col-lg-6 col-md-3 col-sm-3 hidden-xs">
              <div class="pull-right">
                <a href="{{ url('/dashboard/users/add-new') }}"><button class="btn btn-success waves-effect waves-light" id="render-form-button" type="submit">Add New User</button></a>
                <button class="btn btn-success waves-effect waves-light" type="button" onclick="testNotification()">Test Notification</button>
              </div>
          </div>
      </div>

      <div class="row">
        <div class="col-lg-12"> 
          
          <div class="tab-content profile-tab-content"> 
              <div class="tab-pane active" id="admins"> 
                  <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">

                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                      <!-- MAIN CONTENT -->
                                      <section id="main_content" class="inner">
                                      
                                       <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="sticky-table-header fixed-solution">
                                                <table id="datatableAdmin" class="table table-striped table-bordered ">
                                                          <thead>
                                                              <tr>
                                                                  <th>Name</th>
                                                                  <th>Email Address</th>
                                                                  <th>Telephone</th>
                                                                  <th width="12%">Email Confirmed?</th>
                                                                  <th width="5%">Actions</th>
                                                              </tr>
                                                          </thead>

                                                          <tbody>
                                                          @foreach ($usersAdmin as $userAdmin)
                                                              <tr>
                                                                  <td><img src="{{ (empty($userAdmin->avatar)) ? URL::to('/images/users/avatar.png') : $userAdmin->avatar }}" alt="" class="thumb-sm img-circle"><strong style="padding-left: 15px;" >{{ $userAdmin->name }}</strong></td>
                                                                  <td>{{ $userAdmin->email }}</td>
                                                                  <td>{{ $userAdmin->telephone }}</td>
                                                                  <td style="text-align: center;"><?php echo ($userAdmin->emailConfirmed ? '<i style="color: #00B520;" class="fa fa-check">' : '<i style="color: #CE1616;" class="fa fa-times">'); ?></td>
                                                                  <td>
                                                                    <div class="pull-right">
                                                                        <div class="dropdown">
                                                                            <a data-toggle="dropdown" class="dropdown-toggle btn-rounded btn btn-success waves-effect waves-light" href="#"> Actions <span class="caret"></span></a>
                                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                                                <li><a href="#">Edit Details</a></li>
                                                                                @if($userAdmin->id != 0)
                                                                                <li><a href="#">Resend Email Confirmation</a></li>
                                                                                <li><a href="{{ action('AdminPageController@loginUsing', [$userAdmin->id]) }}">Login as this User</a></li>
                                                                                <li><a href="#" class="reset" data-id="{{ $userAdmin->id }}" data-email="{{ $userAdmin->email }}">Send Password Reset Link</a></li>
                                                                                <li><a href="#" class="change-email" data-id="{{ $userAdmin->id }}">Change Email Address</a></li>
                                                                                <li class="divider"></li>
                                                                                <li><a onclick="confirmDelete();" href="#" style="color: #E62121;">Delete Account</a></li>
                                                                                @endif
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                  </td>
                                                              </tr>
                                                          @endforeach
                                                          </tbody>
                                                      </table>
                                                      </div>
                                                  </div>
                                              </div>

                                      </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
              </div> 


              <div class="tab-pane" id="customers">
              <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                  <section id="main_content" class="inner">
                                      <table id="datatableCustomer" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                    <th>Telephone</th>
                                                    <th width="12%">Email Confirmed?</th>
                                                    <th width="5%">Actions</th>
                                                    
                                                </tr>
                                            </thead>

                                            <tbody>
                                                          @foreach ($usersCustomer as $userAdmin)
                                                              <tr>
                                                                  <td><img src="{{ (empty($userAdmin->avatar)) ? URL::to('/images/users/avatar.png') : $userAdmin->avatar }}" alt="" class="thumb-sm img-circle"><strong style="padding-left: 15px;" >{{ $userAdmin->name }}</strong></td>
                                                                  <td>{{ $userAdmin->email }}</td>
                                                                  <td>{{ $userAdmin->telephone }}</td>
                                                                  <td style="text-align: center;"><?php echo ($userAdmin->emailConfirmed ? '<i style="color: #00B520;" class="fa fa-check">' : '<i style="color: #CE1616;" class="fa fa-times">'); ?></td>
                                                                  <td>
                                                                    <div class="pull-right">
                                                                        <div class="dropdown">
                                                                            <a data-toggle="dropdown" class="dropdown-toggle btn-rounded btn btn-success waves-effect waves-light" href="#"> Actions <span class="caret"></span></a>
                                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                                                <li><a href="#">Edit Details</a></li>
                                                                                <li><a href="{{ action('AdminPageController@loginUsing', [$userAdmin->id]) }}">Login as this User</a></li>
                                                                                <li><a href="#">Resend Email Confirmation</a></li>
                                                                                <li><a href="#" class="reset" data-id="{{ $userAdmin->id }}" data-email="{{ $userAdmin->email }}">Send Password Reset Link</a></li>
                                                                                <li><a href="#" class="change-email" data-id="{{ $userAdmin->id }}">Change Email Address</a></li>
                                                                                <li class="divider"></li>
                                                                                <li><a onclick="confirmDelete();" href="#" style="color: #E62121;">Delete Account</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                  </td>
                                                              </tr>
                                                          @endforeach
                                                          </tbody>
                                        </table>
                                  </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
          </div> 



              <div class="tab-pane" id="teammembers">
              <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                  <section id="main_content" class="inner">
                                      <table id="datatableTeamMember" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                    <th>Telephone</th>
                                                    <th width="12%">Email Confirmed?</th>
                                                    <th width="5%">Actions</th>
                                                    
                                                </tr>
                                            </thead>

                                            <tbody>
                                                          @foreach ($usersEventPlanner as $userAdmin)
                                                              <tr>
                                                                  <td><img src="{{ (empty($userAdmin->avatar)) ? URL::to('/images/users/avatar.png') : $userAdmin->avatar }}" alt="" class="thumb-sm img-circle"><strong style="padding-left: 15px;" >{{ $userAdmin->name }}</strong></td>
                                                                  <td>{{ $userAdmin->email }}</td>
                                                                  <td>{{ $userAdmin->telephone }}</td>
                                                                  <td style="text-align: center;"><?php echo ($userAdmin->emailConfirmed ? '<i style="color: #00B520;" class="fa fa-check">' : '<i style="color: #CE1616;" class="fa fa-times">'); ?></td>
                                                                  <td>
                                                                    <div class="pull-right">
                                                                        <div class="dropdown">
                                                                            <a data-toggle="dropdown" class="dropdown-toggle btn-rounded btn btn-success waves-effect waves-light" href="#"> Actions <span class="caret"></span></a>
                                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                                                <li><a href="#">Edit Details</a></li>
                                                                                <li><a href="{{ action('AdminPageController@loginUsing', [$userAdmin->id]) }}">Login as this User</a></li>
                                                                                <li><a href="#">Resend Email Confirmation</a></li>
                                                                                <li><a href="#" class="reset" data-id="{{ $userAdmin->id }}" data-email="{{ $userAdmin->email }}">Send Password Reset Link</a></li>
                                                                                <li><a href="#" class="change-email" data-id="{{ $userAdmin->id }}">Change Email Address</a></li>
                                                                                <li class="divider"></li>
                                                                                <li><a onclick="confirmDelete();" href="#" style="color: #E62121;">Delete Account</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                  </td>
                                                              </tr>
                                                          @endforeach
                                                          </tbody>
                                        </table>
                                  </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
          </div> 
          
          <div class="tab-pane" id="eventplanners">
              <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                  <section id="main_content" class="inner">
                                       <table id="datatableEventPlanner" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                    <th>Telephone</th>
                                                    <th width="12%">Email Confirmed?</th>
                                                    <th width="5%">Actions</th>
                                                    
                                                </tr>
                                            </thead>

                                            <tbody>
                                                          @foreach ($usersTeamMember as $userAdmin)
                                                              <tr>
                                                                  <td><img src="{{ (empty($userAdmin->avatar)) ? URL::to('/images/users/avatar.png') : $userAdmin->avatar }}" alt="" class="thumb-sm img-circle"><strong style="padding-left: 15px;" >{{ $userAdmin->name }}</strong></td>
                                                                  <td>{{ $userAdmin->email }}</td>
                                                                  <td>{{ $userAdmin->telephone }}</td>
                                                                  <td style="text-align: center;"><?php echo ($userAdmin->emailConfirmed ? '<i style="color: #00B520;" class="fa fa-check">' : '<i style="color: #CE1616;" class="fa fa-times">'); ?></td>
                                                                  <td>
                                                                    <div class="pull-right">
                                                                        <div class="dropdown">
                                                                            <a data-toggle="dropdown" class="dropdown-toggle btn-rounded btn btn-success waves-effect waves-light" href="#"> Actions <span class="caret"></span></a>
                                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                                                <li><a href="#">Edit Details</a></li>
                                                                                <li><a href="{{ action('AdminPageController@loginUsing', [$userAdmin->id]) }}">Login as this User</a></li>
                                                                                <li><a href="#">Resend Email Confirmation</a></li>
                                                                                <li><a href="#" class="reset" data-id="{{ $userAdmin->id }}" data-email="{{ $userAdmin->email }}">Send Password Reset Link</a></li>
                                                                                <li><a href="#" class="change-email" data-id="{{ $userAdmin->id }}">Change Email Address</a></li>
                                                                                <li class="divider"></li>
                                                                                <li><a onclick="confirmDelete();" href="#" style="color: #E62121;">Delete Account</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                  </td>
                                                              </tr>
                                                          @endforeach
                                                          </tbody>
                                        </table>
                                  </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
          </div> 


          </div>

          


        </div> 

  </div>
</div>
</div>

@endsection




@section('footer-css')


@endsection

@section('footer-js')
    
<script>
function confirmDelete(){
    sweetAlert({
      title: 'Are you sure?',
      text: "You won't be able to recover the account once deleted!",
      type: 'warning',
      showCancelButton: true,
      cancelButtonColor: '#1D81BB',
      confirmButtonColor: '#E02222',
      confirmButtonText: 'Yes, delete it!',
      closeOnConfirm: false
    },
    function(isConfirm) {
      if (isConfirm) {
        sweetAlert(
          'Deleted!',
          'Your account has been deleted.',
          'success'
        );
      }
    })
}




</script>

<script type="text/javascript">
                function testNotification() {
                
                 swal(
                      {title: "Send now?",
                          text: "",
                          type: "warning",
                          showCancelButton: true,
                          confirmButtonColor: "#DD6B55",
                          confirmButtonText: "Show notification",
                          cancelButtonText: "Cancel",
                          closeOnConfirm: false
                      },
                      function(isConfirm){
                          showPreloader();
                          if (isConfirm) {
                              $.ajax(
                                  {
                                      type: "post",
                                      url: 'show_notification',
                                      data: { 
                                          'title': 'Your notification title', 
                                          'message': 'Your notification body', 
                                          'icon': 'fa-calendar',
                                          'link': 'dashboard/settings'
                                      },
                                      success : function(data){
                                          swal("Successful!", "", "success");
                                          //console.log(data);
                                          hidePreloader();
                                      },
                                      error: function(xhr, ajaxOptions, thrownError) {
                                          console.log(thrownError);

                                          swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
                                      }
                                  });
                          }
                      }
                  );
              }

            $(document).ready(function() {
                $('#datatableAdmin').dataTable();
                $('#datatableCustomer').dataTable();
                $('#datatableEventPlanner').dataTable();
                $('#datatableTeamMember').dataTable();

                $(".reset").click(function(){
                      sweetAlert({
                        title: 'Confirm sending password reset mail to ' + $(this).attr("data-email"),
                        text: "The user will receive an email with password reset link.",
                        type: 'warning',
                        showCancelButton: true,
                        cancelButtonColor: '#1D81BB',
                        confirmButtonColor: '#E02222',
                        confirmButtonText: 'Yes, delete it!',
                        closeOnConfirm: false
                      },
                      function(isConfirm) {
                        if (isConfirm) {
                          $.ajax({
                              url: '/password/email/resend',
                              type: 'POST',
                              data: {_token: CSRF_TOKEN, email: $(this).attr("data-email")},
                              dataType: 'JSON',
                              success: function () {
                                  sweetAlert(
                                    'Email Sent!',
                                    'The user will now be able to reset the password.',
                                    'success'
                                  );
                              }, 
                              error: function() {
                                  sweetAlert(
                                    'Email Sent!',
                                    'The user will now be able to reset the password.',
                                    'error'
                                  );
                              }
                          });

                          
                        }
                      })
                });
                
               

                $(".change-email").click(function(){
                   var userID = $(this).attr("data-id");

                      sweetAlert({
                        title: 'Are you sure you want to change the email?',
                        text: "The user will not be able to login from previous email address.",
                        type: 'warning',
                        showCancelButton: true,
                        cancelButtonColor: '#1D81BB',
                        confirmButtonColor: '#E02222',
                        confirmButtonText: 'Yes, change it!',
                        closeOnConfirm: false
                      },
                      function(isConfirm) {
                        if (isConfirm) {

                          $.ajax({
                              url: '/change-email',
                              type: 'POST',
                              data: {_token: CSRF_TOKEN, id: 'TEST'},
                              dataType: 'JSON',
                              success: function () {
                                  sweetAlert(
                                    'Email Sent!',
                                    'The user will now be able to reset the password.',
                                    'success'
                                  );
                              }, 
                              error: function() {
                                  sweetAlert(
                                    'Email Sent!',
                                    'The user will now be able to reset the password.',
                                    'error'
                                  );
                              }
                          });

                          
                        }
                      })
                });

            }); //End Document Ready


    </script>

<script src="{{asset('assets/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/datatables/dataTables.bootstrap.js')}}"></script>

@endsection