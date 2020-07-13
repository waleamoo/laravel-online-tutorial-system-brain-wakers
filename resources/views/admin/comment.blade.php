@extends('layouts.admin')
@section('title')
Brain Wakers | Comments
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Comments
        <small>Reply Comments</small>
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

        <div class="col-md-12">
            @include('include.message')
            @if (count($comments) > 0)
            
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">All Comments
                    </h3>
                </div>

                <table class="table-responsive">

                    <tr>
                        <th style="width:50%">Comment</th>
                        <th style="width:50%">Reply</th>
                    </tr>
                    @foreach ($comments as $comment)
                    <tr>
                        <td>
                            {{ $comment->comment_body }} <br>
                            @if (!empty($comment->comment_image))
                            <img src="/images/{{ $comment->comment_image }}" alt="comment image">
                            @endif
                        </td>
                        <td>
                            @if (!empty($comment->reply_body))
                            <form method="POST" action="{{ route('admin.comment') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="box-body">

                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">

                                    <div class="form-group">
                                        <label for="subject">Reply Message</label>
                                        <textarea class="form-control" name="reply" id="reply" cols="30"
                                            rows="10"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="select_file">Image(Optional)</label>
                                        <input type="file" name="select_file" id="select_file">
                                        <p class="help-block">Max 2MB.</p>
                                    </div>

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit Reply</button>
                                    </div>

                                </div>
                            </form>
                            @else
                                {{ $comment->reply_body }} <br>
                                @if (!empty($comment->reply_image))
                                    <img src="/images/{{ $comment->reply_image }}" alt="reply image">
                                @endif
                            @endif
                            
                        </td>
                    </tr>
                    @endforeach
                </table>

            </div>
            
            @else
            <h2>No comments available</h2>
            @endif

        </div>

    </div>
    <!-- /.row (main row) -->

</section>
<!-- /.content -->
@endsection