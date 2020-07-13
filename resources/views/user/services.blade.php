@extends('layouts.master')

@section('title')
Brain Wakers | Services
@endsection

@section('content')
<div class="container">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3>We are school away from school</h3>
                <blockquote class="text-white">Learning has to be limitless</blockquote>
                <p class="lead text-white">
                     With this in mind, the Brain Wakers Team is using this platform to 
                    as a medium to impact necessary knowledge needed for academic excellence in schools. Do you need 
                    extra lesson or perhaps more in-depth explanation about the topics and subject taught in school? 
                    Brain Wakers Tutorial is the right solution for you. Below are our services.
                </p>

                <h3>Online Learning</h3>
                <p class="lead text-white">
                    Either you are a parent, student or teacher, we all are learners at Brain Wakers. The only 
                    way to connect learners from diverse locations, tribes or even countries is the with the use of 
                    the internet as a tool. Hence, the need for the online learning.
                </p>

                <h3>Online Teaching</h3>
                <p class="lead text-white">
                    We help teachers connect to their students using the internet as a medium. 
                </p>

                <h3>Academic Support</h3>
                <p class="lead text-white">
                    Brain Wakers provide academic support for learners to help them excell in their academics. 
                    Either it is a school test, WASSCE, JAMB, NECO or GCE, we are here to support you in your 
                    quest to achieve success.  
                </p>
                
            </div>

            @include('include.side')

        </div>


    </div>
</div>
@endsection