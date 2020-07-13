@extends('layouts.master')

@section('title')
Brain Wakers | Activation 
@endsection

@section('content')
<div class="container">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3>Activation Resend Form</h3>
                <p class="text-muted">
                    Enter your registered email address you submitted at registration
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

                <form action="{{ route('postActive') }}" method="POST">
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-form-label" for="password">E-Mail Address</label>
                        <input type="email" name="email" class="form-control w-75" placeholder="E-Mail Address" id="email" value="{{ old('email')}}">
                        
                        @if ($errors->has('email'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-btn fa-user"></i> Resend Activation Code</button>

                </form>
            </div>
    
            @include('include.side')
        </div>
        

    </div>
</div>
@endsection