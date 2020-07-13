@extends('layouts.master')

@section('title')
Brain Wakers | Contact
@endsection

@section('content')
<div class="container">
    <div class="container">
        <div class="row my-4">
            <div class="col-md-12">
                <h2 class="lead">Send us a message:</h2>
            </div>

            <div class="col-lg-4 col-sm-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        Reach us at:
                    </div>
                    <div class="card-body">
                        <p class="text-white">
                            10 Obe Str.
                            <br>Shibiri, Lagos
                            <br>
                        </p>
                        <p class="text-white">
                            <abbr title="Phone">P</abbr>: <a href="tel:+2348080978412">0808-0978-412</a>
                        </p>
                        <p class="text-white">
                            <abbr title="Email">E</abbr>:
                            <a href="mailto:admin@brainwakers.com">admin@brainwakers.com
                            </a>
                        </p>
                    </div>
                </div>
    
            </div>

            <div class="col-lg-8 col-sm-8 mb-4">
                <div class="card">
                    <div class="card-header">
                        Contact us
                    </div>
                    <div class="card-body">
                        <!--<iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=56.506174,79.013672&amp;t=m&amp;z=4&amp;output=embed"></iframe>
                        <hr>-->
                        @include('include.message')
                        <form action="{{ route('user.contact') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">Name</label>
                            <input type="text" value="{{ old('name')}}" class="form-control" id="name" name="name" placeholder="Name">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" value="{{ old('email')}}" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                <small id="emailHelp" class="form-text text-muted">Just for reply and feedbacks. Your email will not be shared.</small>
                            </div>
    
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="phone" value="{{ old('phone')}}" class="form-control" id="phone" name="phone" aria-describedby="phone" placeholder="Phone">
                                <small id="emailHelp" class="form-text text-muted">Just for reply and feedbacks. Your phone number will not be shared.</small>
                            </div>

                            <div class="form-group">
                                <label for="msg">Message</label>
                                <textarea class="form-control" name="msg" id="msg" cols="30" rows="10" placeholder="Your message..">{{ old('msg')}}</textarea>
                            </div>
    
                            <button type="submit" class="btn btn-success btn-lg">Send Message</button>
                        </form>
    
                    </div>
                </div>
    
            </div>


        </div>


    </div>
</div>
@endsection