@extends('layouts.master')

@section('title')
Brain Wakers | Course
@endsection

@section('content')
<div class="container">
  <div class="container">
    <div class="row">
      <div class="col-md-8 mt-3">

          @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h4 class="alert-heading"><strong>{{ session('success') }} {{ Auth::user()->name }}!</strong></h4>
          <p>We're so happy to have you on board. We hope this journey will be a worthwhile and rewarding one for you.</p>
          <hr>
          <p class="mb-0">Learning is limitless. Let's get started!</p>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif


        @if (count($courses) > 0)
        <h3>Your Course(s)</h3>
        <div class="row">
          @foreach ($courses as $course)
          <div class="card border-info m-3" style="max-width: 20rem;">
            <h5 class="card-header text-capitalize"> {{ $course->course_name }} {{ $course->subject_name }} Course </h5>
            <div class="card-body">
              <p class="card-text text-white">by {{ $course->tutor }}</p>
              <a href="{{ route('user.classroom', ['id' => $course->course_id ])}}" class="btn btn-primary">Go to Course</a>
            </div>
          </div>
          @endforeach
        </div>
        @else
        <div class="row">
          <div class="col-md-10 offset-md-1 mt-4">
            <h2 class="display-4">No course.</h2>
          </div>
        </div>
        @endif

      </div>

      @include('include.side')
    </div>


  </div>
</div>
@endsection