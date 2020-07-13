@extends('layouts.master')

@section('title')
Brain Wakers | Login
@endsection

@section('content')
<div class="container">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3>Student Login</h3>
                <p class="text-muted">
                    Enter your registered email address and password you provided at registration
                </p>
    
                
                @if (session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('warning') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <b>{{ session('error') }}</b>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>
                @endif
                
                <form action="#" method="POST">
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-form-label" for="password">E-Mail Address</label>
                        <input type="email" name="email" class="form-control w-75" placeholder="E-Mail Address" id="email" value="{{ old('email')}}">
                        
                        @if ($errors->has('email'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label class="col-form-label" for="password">Password</label>
                        <input type="password" name="password" class="form-control w-75" placeholder="Password" id="password" value="">
                        
                        @if ($errors->has('password'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="remember" class="custom-control-input" id="customCheck1" checked>
                            <label class="custom-control-label" for="customCheck1">Remember me</label>
                          </div>
                    </div>
                    
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-btn fa-user"></i> Log In</button>
                <p><a href="{{ url('user/register') }}">Not yet a member? Register here</a> <br>
                <a href="{{ url('password/reset') }}">Forgot Password? Cick here</a> <br>
                <a href="{{ url('user/active') }}">Resend registeration activation code</a>
            </p>

                    
                </form>
            </div>
    
            @include('include.side')
        </div>
        

    </div>
</div>
@endsection