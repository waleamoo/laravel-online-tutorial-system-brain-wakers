@extends('layouts.master')

@section('title')
Brain Wakers | Search Result
@endsection

@section('content')
<div class="container">
    <div class="container">

        <div class="row mt-4">
            <div class="col-md-8">
                @include('include.message')
            </div>
        </div>

        @if (count($courses) > 0)
        <div class="col-md-12">
            <h3>Course Search</h3>
        </div>
        @foreach ($courses as $course)
        <div class="row">
            
            
            <div class="col-md-8">
                
                <!-- chuck course 2 per row -->
                <div class="row">
                    <div class="card border-info m-3" style="width: 100%;">
                        <h5 class="card-header text-capitalize">{{ $course->course_name }} {{ $course->subject_name }} course
                        </h5>
                        <div class="card-body text-white">
                            <div class="card-text make-white">
                                <span style="font-size: 2rem;">Course Fee: ₦{{ $course->fee}}.00</span> <br><br>
                                <!-- Benefit and Topics -->
                                
                                <br>
                                Class tutored by: <span style="font-weight: bold;">{{$course->tutor}}</span>
                                <br><br>
                            </div>

                            <a href="{{ route('getCourse', ['sub_id' => $course->subject_id, 'id' => $course->id] )}}" class="btn btn-info">View Course Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="row">
            <div class="col-md-10 offset-md-1 mt-4">
                <h2 class="display-4">No course yet for the searched subject.</h2>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection