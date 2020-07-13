@extends('layouts.master')

@section('title')
Brain Wakers | Classroom
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 mt-4">
        <h5>Topic: {!! $tutorial->sub_topic !!}</h5>
        <div class="row" style="position: relative;">
          {!! $tutorial->video !!}
        </div>
        <br>
        <div class="row">
          <div class="container">
            <?php $prev = $tutorial->id - 1; if($prev == 0){$prev = 1; } ?>
            <a href="{{ route('user.topic', ['lecture_id' => $lecture_id, 'id' => $prev]) }}" class="btn btn-danger btn-outline-success btn-lg float-left"> &larr; Previous Lecture </a>
            
            <?php $next = $tutorial->id + 1; // 6
            $last_number = DB::table('lectures')->select(DB::raw('MAX(id) as id'))->where('course_id', $lecture_id)->value('id');
            //echo  $last_number;
            if($next > $last_number){
              $next--;
            }
            ?>
            <a href="{{ route('user.topic', ['lecture_id' => $lecture_id, 'id' => $next]) }}" class="btn btn-success btn-outline-danger btn-lg float-right">Next Lecture &rarr; </a>
          </div>
        </div>

        <br>

          <div class="row">
            <div class="card" style="width: 90%;">
              <div class="card-header">Ask a Question or make a comment</div>
              <div class="card-body">
                <div class="alert" id="message"></div>
              <form action="{{ route('user.comment') }}" method="POST" enctype="multipart/form-data">
                @include('include.message')
                  {{ csrf_field() }}
                  <input type="hidden" name="lecture_id" value="{{ $lecture_id }}">
                  <textarea class="form-control" name="comment" id="comment" cols="30" rows="5" placeholder="Your comment or question"></textarea>
                  <br>
                  <input type="file" name="select_file" id="select_file" class="form-control">
                  <br>
                  <button type="submit" class="btn btn-primary btn-lg align-content-right">Submit Input</button>
                  
                </form>
              </div>
            </div>
          </div>

          <br>
          <div class="row">
            <div class="card" style="width: 90%;">
              <div class="card-body">
                <form action="{{ route('user.fetchComment') }}" method="POST" role="form">
                  <input type="text"class="form-control" name="searchComment" id="searchComment" placeholder="Search comment or question">
                  {{ csrf_field() }}
                </form>
              </div>
            </div>
          </div>

          <br>

          <div class="row">
            <div class="table-responsive">
              <table>
                <tbody>
                  @if (count($comments) > 0)
                    @foreach ($comments as $comment)
                    <tr>
                    <td style="padding-right: 4rem;">{{ $comment->comment_body }} <br> 
                      @if (!empty($comment->comment_image))
                    <img src="/images/{{$comment->comment_image}}" class="img-responsive">
                      @endif
                      <i class="text-muted">by <?php echo \App\User::where('id', $comment->user_id)->value('name'); ?> on <?php $date = $comment->created_at; echo $date->format('M-d H:i'); ?></i></td>
                      <td></td>
                    </tr>

                    <?php $reply = DB::table('replies')->where('comment_id', $comment->id)->first(); ?>
                    @if (!empty($reply))
                    <tr>
                      <td></td>
                      <td>{{ $reply->reply_body }} <br> <i class="text-muted">by Admin</i>
                      <br>
                      @if (!empty($reply->reply_image))
                    <img src="/images/{{$reply->reply_image}}" class="img-responsive">
                      @endif
                      </td>
                    </tr>
                    @endif
                    
                    @endforeach
                  @else
                    <tr colspan="2" align="center"><h2 class="lead">No comments or contributions yet.</h2></tr>
                  @endif
                  
                </tbody>
              </table>
            </div>
          </div>

      </div>

      <!-- side bar section-->
    <div class="col-md-4 mt-4">
      <div id="accordion">
        <?php $topics = DB::table('lectures')->select('topic')->where('course_id', $lecture_id)->distinct()->get(); ?>
        
        @foreach ($topics as $topic)
        <?php $idprint = DB::table('lectures')->select('id')->where('topic', $topic->topic)->value('id'); ?>
          <div class="card border-info  mb-2">
            <div class="card-header" id="idprint">
              <h5 class="mb-0">
                <button class="btn" data-toggle="collapse" data-target="#collapse<?php echo $idprint; ?>" aria-expanded="<?php if($idprint == "1"){echo "true";}else{ echo "false"; } ?>"
                  aria-controls="collapse<?php echo $idprint; ?>">
                  {{ $topic->topic }}
                </button>
              </h5>
            </div>

            <div id="collapse<?php echo $idprint; ?>" class="collapse show" aria-labelledby="idprint" data-parent="#accordion">
              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <?php $lectures = DB::table('lectures')->select('*')->where('topic', $topic->topic)->get(); ?>
                  @foreach ($lectures as $lecture)
                    <li class="list-group-item">
                    <a href="#"><a href="{{ route('user.topic', ['lecture_id' => $lecture_id, 'id' => $lecture->id]) }}" style="text-decoration: none;">{{ $lecture->sub_topic }}</a></a>
                      
                    </li>
                  @endforeach
                  

                </ul>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="card border-info  my-4">
        <div class="card-header">Write a review</div>
        <div class="card-body">
        <a href="{{ route('user.review') }}" target="_blank" class="btn btn-success btn-block">Give us your feedback</a>
        </div>
        </div>
    </div>

    </div>

    

  </div>
</div>

@endsection