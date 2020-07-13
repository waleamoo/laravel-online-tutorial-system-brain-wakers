@extends('layouts.admin')
@section('title')
Brain Wakers | Course
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Course and Subject
        <small>Create and modify subjects and courses</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Comments</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->

    <!-- Main row -->
    <div class="row">

        <div class="col-md-6">
            
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Course
                    </h3>
                </div>
                <div class="box-body">
                    @include('include.message')
                    <form method="POST" action="{{ route('admin.addCourse') }}">
                        {{ csrf_field() }}
                        <div class="box-body">

                            <div class="form-group">
                                <label for="course_name">Course Name</label>
                                <input type="text" class="form-control" name="course_name" placeholder="e.g. SS1" id="course_name">
                            </div>

                            <div class="form-group">
                                <label for="fee">Course Fee</label>
                                <input type="text" class="form-control" name="fee" placeholder="e.g. 1500" id="fee">
                            </div>

                            <div class="form-group">
                                <label for="subject">Subject Name</label>
                                <select class="form-control" name="subject" id="subject">
                                    <?php $subjects =  \App\Subject::all(); ?>
                                    <option>Select a Subject..</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id}}">{{ $subject->subject_name }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="benefits">Course Benefits</label>
                                <textarea class="form-control" name="benefits" id="benefits" placeholder=" | - separated benefits of the course" cols="30" rows="10"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="tutor">Tutor Name</label>
                                <input type="text" class="form-control" name="tutor" placeholder="e.g. Mr. Mike" id="tutor">
                            </div>

                            <div class="form-group">
                                <label for="topics">Course Topics</label>
                                <textarea class="form-control" name="topics" id="topics" placeholder=" | - separated topics to be covered in the course" cols="30" rows="10"></textarea>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit Course</button>
                            </div>

                        </div>
                    </form>

                    

                </div>

            </div>

        </div>

        <div class="col-md-6">
            
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Subject
                    </h3>
                </div>
                <div class="box-body">
                    @include('include.message')
                    <form method="POST" action="{{ route('admin.addSubject') }}">
                        {{ csrf_field() }}
                        <div class="box-body">

                            <div class="form-group">
                                <label for="subject_name">Subject Name</label>
                                <input type="text" class="form-control" name="subject_name" placeholder="e.g. Mathematics" id="subject_name">
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit Subject</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">All Subjects
                    </h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>Subject Name</th>
                                <th>&nbsp;</th>
                            </tr>
                            <?php $subjects =  \App\Subject::all(); ?>
                                    @foreach ($subjects as $subject)
                            <tr>
                            <td>{{ $subject->id}}</td>
                            <td>{{ $subject->subject_name}}</td>
                            <td><a href="{{ route('admin.deleteSubject', ['id' => $subject->id ]) }}"><i class="fa fa-trash"></i> <span>Delete</span></a></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

        </div>



        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">All Courses
                    </h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table-responsive table-bordered">
                            <tr>
                                <th>Course Name</th>
                                <th>Fee</th>
                                <th>Subject</th>
                                <th>Benefits</th>
                                <th>Tutor</th>
                                <th>Topics</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                            @foreach ($courses as $course)
                            <tr>
                                <td>
                                    {{$course->course_name}}
                                </td>
                                <td>
                                    ₦{{$course->fee}}.00
                                </td>
                                <td>
                                    <?php echo \App\Subject::where('id', $course->subject_id)->value('subject_name'); ?>
                                </td>
                                <td>
                                    {{$course->benefits}}
                                </td>
                                <td>
                                    {{$course->tutor}}
                                </td>
                                <td>
                                    {{$course->topics}}
                                </td>
                                <td><a href="{{ route('admin.deleteCourse', ['id' => $course->id ]) }}"><i class="fa fa-trash"></i> <span>Delete</span></a></td>
                                <td><a href="{{ route('admin.editCourse', ['id' => $course->id]) }}"><i class="fa fa-edit"></i> <span>Edit</span></a></td>
                            </tr>
    
                            @endforeach
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>
    <!-- /.row (main row) -->

</section>
<!-- /.content -->
@endsection