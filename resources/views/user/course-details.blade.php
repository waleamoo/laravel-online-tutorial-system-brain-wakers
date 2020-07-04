@extends('layouts.master')

@section('title')
Brain Wakers | Course Details
@endsection

@section('content')
<div class="container">
    <div class="container">

        <div class="row mt-4">
            <div class="col-md-8">
            @include('include.message')
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <h3>Course Details</h3>

                <!-- chuck course 2 per row -->
                <div class="row">
                    <div class="card border-info m-3" style="width: 100%;">
                        <h5 class="card-header text-capitalize">{{ $course->course_name }} {{ $subject_name }} course </h5>
                        <div class="card-body text-white">
                            <div class="card-text make-white">
                                <span style="font-size: 2rem;">Course Fee: ₦{{ $course->fee}}.00</span> <br><br>
                                
                                Benefits include the following: <br>
                                <ol>
                                    @foreach ($benefits as $benefit)
                                        <li>{{$benefit}}</li>
                                    @endforeach
                                </ol>
                                <br>
                                Topics covered include the following: <br>
                                <ol>
                                    @foreach ($topics as $topic)
                                        <li>{{$topic}}</li>
                                    @endforeach
                                </ol>
                                <br>
                                Class tutored by: <span style="font-weight: bold;">{{$course->tutor}}</span>
                                <br><br>
                            </div>
                            <a href="{{ route('addCourse', ['id' => $course->id] )}}" class="btn btn-success">Add To Cart</a>
                        </div>
                    </div>
                </div>
            </div>
            @include('include.side')
        </div>
    </div>
</div>
@endsection