@extends('layouts.admin')
@section('title')
Brain Wakers | Update
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Course Update
        <small>Update course</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Course Update</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->

    <!-- Main row -->
    <div class="row">

        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Course
                    </h3>
                </div>
                <div class="box-body">
                    @include('include.message')
                    <form method="POST" action="{{ route('admin.updateCourse') }}">
                        {{ csrf_field() }}
                        <div class="box-body">

                        <input type="hidden" name="id" value="{{ $course->id }}">

                            <div class="form-group">
                                <label for="course_name">Course Name</label>
                            <input type="text" class="form-control" value="{{ $course->course_name }}" name="course_name" placeholder="e.g. SS1" id="course_name" readonly>
                            </div>

                            <div class="form-group">
                                <label for="fee">Course Fee</label>
                                <input type="text" class="form-control" value="{{ $course->fee }}" name="fee" placeholder="e.g. 1500" id="fee">
                            </div>

                            <div class="form-group">
                                <label for="subject">Subject Name</label>
                                <input type="text" class="form-control" value="<?php echo \App\Subject::where('id', $course->subject_id)->value('subject_name'); ?>" name="subject_name" id="subject_name" readonly>
                            </div>

                            <div class="form-group">
                                <label for="benefits">Course Benefits</label>
                                <textarea class="form-control" name="benefits" id="benefits" cols="30" rows="10">{{ $course->benefits }}</textarea>
                                <small>Benefits must be | - separated </small>
                            </div>

                            <div class="form-group">
                                <label for="tutor">Tutor Name</label>
                                <input type="text" class="form-control" value="{{ $course->tutor }}" name="tutor" placeholder="e.g. Mr. Mike" id="tutor">
                            </div>

                            <div class="form-group">
                                <label for="topics">Course Topics</label>
                                <textarea class="form-control" name="topics" id="topics" cols="30" rows="10">{{ $course->topics }}</textarea>
                                <small>Topic must be | - separated </small>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit Course</button>
                            </div>

                        </div>
                    </form>

                    

                </div>

            </div>
        </div>

    </div>
    <!-- /.row (main row) -->

</section>
<!-- /.content -->
@endsection