@extends('layouts.admin')
@section('title')
Brain Wakers | Update
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Lecture Update
        <small>Update lecture</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Lecture Update</li>
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
                    <h3 class="box-title">Update Lecture
                    </h3>
                </div>
                <div class="box-body">
                    @include('include.message')
                    <form method="POST" action="{{ route('admin.updateLecture') }}">
                        {{ csrf_field() }}
                        <div class="box-body">

                        <input type="hidden" name="id" value="{{ $lecture->id }}">

                            <div class="form-group">
                                <label for="subject_name">Subject</label>
                            <input type="text" class="form-control" value="<?php echo \App\Subject::where('id', $lecture->subject_id)->value('subject_name'); ?>" name="subject_name" id="subject_name" readonly>
                            </div>

                            <div class="form-group">
                                <label for="Course">Course</label>
                                <input type="text" class="form-control" value="<?php echo \App\Course::where('id', $lecture->course_id)->value('course_name'); ?>" name="fee" readonly>
                            </div>

                            <div class="form-group">
                                <label for="topic">Topic</label>
                                <input type="text" class="form-control" value="{{ $lecture->topic }}" name="topic" id="topic">
                            </div>

                            <div class="form-group">
                                <label for="sub_topic">Sub-Topic</label>
                            <input type="text" class="form-control" value="{{ $lecture->sub_topic }}" name="sub_topic" id="sub_topic">
                            </div>

                            <div class="form-group">
                                <label for="video">Video/PDF link</label>
                                <input type="text" class="form-control" value="{{ $lecture->video }}" name="video" id="video">
                                <small>PDF 750x480 Video 750x470</small>
                            </div>

                            <div class="form-group">
                                {!! $lecture->video !!}
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