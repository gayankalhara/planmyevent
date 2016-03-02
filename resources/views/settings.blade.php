{{-- Home Page --}}

@extends('master')

@section('content')

<div class="content">
                    <div class="container">

								<div class="panel panel-default panel-fill">
                                    <div class="panel-heading"> 
                                        <h3 class="panel-title">Edit Profile</h3> 
                                    </div> 
                                    <div class="panel-body"> 
                                        <form role="form" lpformnum="1">
                                            <div class="form-group">
                                                <label for="FullName">Name</label>
                                                <input type="text" value="Gayan Kalhara" id="FullName" class="form-control" style="cursor: auto;">
                                            </div>
                                            <div class="form-group">
                                                <label for="Email">Email</label>
                                                <input type="email" value="gayan.csnc@gmail.com" id="Email" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="Username">Username</label>
                                                <input type="text" value="gayankalhara" id="Username" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="Password">Password</label>
                                                <input type="password" placeholder="6 - 15 Characters" id="Password" class="form-control" style="cursor: auto; background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat;">
                                            </div>
                                            <div class="form-group">
                                                <label for="RePassword">Re-Password</label>
                                                <input type="password" placeholder="6 - 15 Characters" id="RePassword" class="form-control" style=" background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat;">
                                            </div>
                                            
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

@endsection