@extends('layouts.master')

@section('title')
Brain Wakers | Registration
@endsection

@section('content')
<div class="container">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3>Student Registration</h3>
                <p class="text-muted">
                    Registering with us is the beginning of breakthrough in your studies, success in your exams.
                </p>

                @if (session('warning'))
                    <div class="alert alert-warning">
                        {{ session('warning') }}
                    </div>
                @endif

                <form action="{{ route('user.register')}}" method="POST">

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-form-label" for="name">Name</label>
                        <input type="text" name="name" class="form-control w-75" placeholder="Name" id="name"
                            value="{{ old('name')}}">

                        @if ($errors->has('name'))
                        <span class="help-block" style="color: red;">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif

                    </div>

                    <div class="form-group {{ $errors->has('surname') ? ' has-error' : '' }}">
                        <label class="col-form-label" for="surname">Surname</label>
                        <input type="text" name="surname" class="form-control w-75" placeholder="Surname" id="surname"
                            value="{{ old('surname')}}">

                        @if ($errors->has('surname'))
                        <span class="help-block" style="color: red;">
                            <strong>{{ $errors->first('surname') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                        <label class="col-form-label" for="address">Address</label>
                        <input type="text" name="address" class="form-control w-75" placeholder="Adress" id="address"
                            value="{{ old('address')}}">

                        @if ($errors->has('address'))
                        <span class="help-block" style="color: red;">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label class="col-form-label" for="phone">Phone Number</label>
                        <input type="text" name="phone" class="form-control w-75" placeholder="Phone Number" id="phone"
                            value="{{ old('phone')}}">

                        @if ($errors->has('phone'))
                        <span class="help-block" style="color: red;">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
                        <label class="col-form-label" for="dob">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control w-75" placeholder="Date of Birth"
                            id="dob" value="{{ old('date_of_birth')}}">

                        @if ($errors->has('date_of_birth'))
                        <span class="help-block" style="color: red;">
                            <strong>{{ $errors->first('date_of_birth') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">

                        <label class="col-form-label">Gender</label>

                        <div class="custom-control custom-radio">
                            <input type="radio" id="male" name="gender" class="custom-control-input">
                            <label class="custom-control-label" for="male">Male</label>
                        </div>

                        <div class="custom-control custom-radio ">
                            <input type="radio" id="female" name="gender" class="custom-control-input">
                            <label class="custom-control-label" for="female">Female</label>
                        </div>

                        @if ($errors->has('gender'))
                        <span class="help-block" style="color: red;">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-form-label" for="password">E-Mail Address</label>
                        <input type="email" name="email" class="form-control w-75" placeholder="E-Mail Address"
                            id="email" value="{{ old('email')}}">
                        <small class="form-text text-muted">Will not be shared. Just for logins and occasional messages
                            from Brain-wakers</small>

                        @if ($errors->has('email'))
                        <span class="help-block" style="color: red;">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label class="col-form-label" for="password">Password</label>
                        <input type="password" name="password" class="form-control w-75" placeholder="Password"
                            id="password" value="{{ old('password')}}">

                        @if ($errors->has('password'))
                        <span class="help-block" style="color: red;">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                        <label class="col-form-label" for="conPassword">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control w-75"
                            placeholder="Confirm Password" id="conPassword" value="{{ old('confirm_password')}}">

                        @if ($errors->has('confirm_password'))
                        <span class="help-block" style="color: red;">
                            <strong>{{ $errors->first('confirm_password') }}</strong>
                        </span>
                        @endif
                    </div>



                    <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-btn fa-user"></i>
                        Register</button>



                    {{ csrf_field() }}

                </form>

            </div>

            @include('include.side')

        </div>


    </div>
</div>
@endsection