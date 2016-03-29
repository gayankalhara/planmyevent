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
                                                    <div class="col-lg-9 col-lg-offset-3">
                                                    <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('Name')}}</div>
                                                    </div>
                                            @endif

                                            <div class="form-group">
                                                <label for="Email">Email</label>
                                                <input name="Email" type="email" value="{{ $userDetail->email }}" id="Email" class="form-control">
                                            </div>
                                            @if ($errors->first('Email'))
                                                    <div class="col-lg-9 col-lg-offset-3">
                                                    <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('Email')}}</div>
                                                    </div>
                                            @endif


                                            <div class="form-group">
                                                <label for="Telephone">Telephone</label>
                                                <input name = "Telephone" type="text" value="{{ $userDetail->telephone }}" id="Telephone" class="form-control">
                                            </div>
                                            @if ($errors->first('Telephone'))
                                                    <div class="col-lg-9 col-lg-offset-3">
                                                    <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('Telephone')}}</div>
                                                    </div>
                                            @endif


                                            <div class="form-group">
                                                <label for="Password">Password</label>
                                                <input name="Password" type="password" placeholder="" id="Password" class="form-control" style="cursor: auto; background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat;">
                                            </div>
                                            @if ($errors->first('Password'))
                                                    <div class="col-lg-9 col-lg-offset-3">
                                                    <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('Password')}}</div>
                                                    </div>
                                            @endif


                                            <div class="form-group">
                                                <label for="RePassword">Re-Password</label>
                                                <input name="RePassword" type="password" placeholder="" id="RePassword" class="form-control" style=" background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat;">
                                            </div>
                                            @if ($errors->first('RePassword'))
                                                    <div class="col-lg-9 col-lg-offset-3">
                                                    <div class="alert alert-danger"  style="margin-bottom:0; margin-top:5px; padding:6px;">{{$errors->first('RePassword')}}</div>
                                                    </div>
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
                                                <label for="FullName">Enter <span style="color: red;">deleteme</span> in the text box below to deactivate your account.</label>
                                                <input type="text" value="" id="FullName" class="form-control" style="cursor: auto; background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat;">
                                            </div>
                                            
                                            <a href="{{ url('/deactivate') }}"><button class="btn btn-primary waves-effect waves-light w-md" type="button" style="background-color: #E51E1E; border: 1px solid #E51E1E;">Deactivate</button></a>
                                        </form>

                                    </div> 
                                </div>
    </div>
</div>

@endforeach

@endsection