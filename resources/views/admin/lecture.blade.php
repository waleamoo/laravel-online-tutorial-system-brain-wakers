@extends('layouts.admin')
@section('title')
Brain Wakers | Lecture
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lecture
    <small>Add Lecture</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->

  <!-- Main row -->
  <div class="row">
    @include('include.message')
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">New Lecture</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="{{ route('admin.lecture') }}" method="POST">
          {{ csrf_field() }}
          <div class="box-body">

            <div class="form-group">
              <label for="subject">Subject</label>
              <select class="form-control dynamic" name="subject" id="subject" data-dependent="course">
                <option>Select a subject..</option>
                <?php  $subjects = \App\Subject::all(); ?>
                @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="subject">Course</label>
              <select class="form-control" name="course" id="course">

              </select>
            </div>

            <div class="form-group">
              <label for="topic">Topic</label>
              <select class="form-control" name="topic" id="topicscourse">

              </select>
            </div>

            <div class="form-group">
              <label for="sub_topic">Sub Topic</label>
              <input type="text" class="form-control" name="sub_topic" id="sub_topic" placeholder="Sub Topic">
            </div>

            <!--
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input type="file" id="exampleInputFile">
                  <p class="help-block">Example block-level help text here.</p>
                </div>

                <div class="checkbox">
                  <label>
                    <input type="checkbox"> Check me out
                  </label>
                </div>-->

            <div class="form-group">
              <label for="link">Video Link or pictures</label>
              <input type="text" class="form-control" name="link" id="link" placeholder="Link">
            </div>

          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>

  </div>
  <!-- /.row (main row) -->

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">All Lectures</h3>

          <div class="box-tools">
            <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
              <select class="form-control pull-right form-control-sm" name="subject" id="subject">
                <option>Select a Subject...</option>
              </select>
            </div>

            <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
              <select class="form-control pull-right form-control-sm" name="course" id="course">
                <option>Select a Course...</option>
              </select>
            </div>

          </div>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table-responsive table-bordered">
              <tr>
                <th>Subject</th>
                <th>Course</th>
                <th>Topic</th>
                <th>Sub-Topic</th>
                <th>Video/PDF Iframe Code</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
              @foreach ($lectures as $lecture)
              <tr>
                <td>
                  <?php echo \App\Subject::where('id', $lecture->subject_id)->value('subject_name'); ?>
                </td>
                <td>
                  <?php echo \App\Course::where('id', $lecture->course_id)->value('course_name'); ?>
                </td>
                <td>
                  {{ $lecture->topic}}
                </td>
                <td>
                  {{$lecture->sub_topic }}
                </td>
                <td>
                  {{$lecture->video}}
                </td>
                <td><a href="{{ route('admin.deleteLecture', ['id' => $lecture->id ]) }}"><i class="fa fa-trash"></i>
                    <span>Delete</span></a></td>
                <td><a href="{{ route('admin.editLecture', ['id' => $lecture->id]) }}"><i class="fa fa-edit"></i>
                    <span>Edit</span></a></td>
              </tr>

              @endforeach
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>

</section>
<!-- /.content -->
@endsection