{{-- Home Page --}}

@extends('master')

@section('content')

@foreach ($userDetails as $userDetail)
<div class="content">
                    <div class="container">

								<div class="panel panel-default panel-fill">
                                    <div class="panel-heading"> 
                                        <h3 class="panel-title">Edit Profile</h3> 
                                    </div> 
                                    <div class="panel-body"> 
                                        <form role="form" method="post" action="{{ url('/dashboard/settings') }}" lpformnum="1">
                                        {!! csrf_field() !!}
                                            <div class="form-group">
                                                <label for="FullName">Name</label>
                                                <input name ="Name" type="text" value="{{ $userDetail->name }}" id="FullName" class="form-control" style="cursor: auto;">
                                            </div>
                                            @if ($errors->first('Name'))
                                                    <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('Name')}}</div>
                                            @endif

                                            <div class="form-group">
                                                <label for="Email">Email</label>
                                                <input name="Email" type="email" value="{{ $userDetail->email }}" id="Email" class="form-control">
                                            </div>
                                            @if ($errors->first('Email'))
                                                    <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('Email')}}</div>
                                            @endif


                                            <div class="form-group">
                                                <label for="Telephone">Telephone</label>
                                                <input name = "Telephone" type="text" value="{{ $userDetail->telephone }}" id="Telephone" class="form-control">
                                            </div>
                                            @if ($errors->first('Telephone'))
                                                    <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('Telephone')}}</div>
                                            @endif
                                            
                                            <div class="form-group">
                                                <label for="password">New Password</label>
                                                <input name="password" type="password" placeholder="" id="Password" class="form-control" style="cursor: auto; background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat;">
                                            </div>
                                            @if ($errors->first('password'))
                                                    <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('password')}}</div>
                                            @endif


                                            <div class="form-group">
                                                <label for="password_confirmation">Re-enter New Password</label>
                                                <input name="password_confirmation" type="password" placeholder="" id="RePassword" class="form-control" style=" background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat;">
                                            </div>
                                            @if ($errors->first('password_confirmation'))
                                                    <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('password_confirmation')}}</div>
                                            @endif

                                            
                                            <button class="btn btn-primary waves-effect waves-light w-md" type="submit">Save</button>
                                        </form>

                                    </div> 
                                </div>



                                <div class="panel panel-default panel-fill">
                                    <div class="panel-heading"> 
                                        <h3 class="panel-title">Delete Account</h3> 
                                    </div> 
                                    <div class="panel-body"> 
                                        <form role="form" lpformnum="1">
                                            <div class="form-group">
                                                <label for="deleteme">Enter <span style="color: red;">deleteme</span> in the text box below to delete your account.</label>
                                                <input type="text" value="" id="deleteme" class="form-control" style="background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat;">
                                            </div>
                                            
                                            <button class="btn btn-primary waves-effect waves-light w-md" type="button" style="background-color: #E51E1E; border: 1px solid #E51E1E;" onclick="deactivateConfirm()">Deactivate</button>
                                        </form>

                                    </div> 
                                </div>
    </div>
</div>

@endforeach

@endsection


@section('footer-js')

<script>
function deactivateConfirm() {
  if(document.getElementById('deleteme').value == "deleteme"){
      swal(
          {title: "Deactivate your account now?",
              text: "This will permanently delete your account. Are you sure?",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Delete Now",
              cancelButtonText: "Cancel",
              closeOnConfirm: false
          },
          function(isConfirm){
              if (isConfirm) {
                  window.location.href = "{{ url('dashboard/deactivate') }}";
              }
          }
      );
  } else{
    swal(
      'Phrase Incorrect!',
      'Enter deleteme in the text box to delete your account.',
      'error'
    )
  }
}
</script>
@endsection

@section('header-css')
<style>
.alert-danger{
   margin-bottom: 20px !important; 
}
</style>
@endsection