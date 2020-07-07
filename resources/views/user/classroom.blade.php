@extends('layouts.master')

@section('title')
Brain Wakers | Classroom
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 mt-4">
      <!-- chuck course 2 per row -->
        <div class="row" style="position: relative;">
          <!--<div class="yt-cover"></div>-->
          <iframe width="750" height="470" src="https://www.youtube.com/embed/SFhbnx4qovw?autoplay=1"
            frameborder="3"></iframe>
          <!-- <iframe id="ytplayer" type="text/html" width="640" height="360"
  src="https://www.youtube.com/embed/M7lc1UVf-VE?autoplay=1&origin=http://example.com"
  frameborder="0"></iframe> -->
        </div>

        <br><br><br><br><br>

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
                      <br>
                      <i class="text-muted">by <?php echo \App\User::where('id', $comment->user_id)->value('name'); ?> on <?php $date = $comment->created_at; echo $date->format('M-d H:i'); ?></i></td>
                      <td></td>
                    </tr>

                    <!--
                    <tr>
                      <td></td>
                      <td><td>Reply gotten from admin <br> <i class="text-muted">by Wale on Jan 01 01</i></td></td>
                    </tr>-->

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
        <div class="card border-info  mb-2">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                aria-controls="collapseOne">
                Collapsible Group Item #1
              </button>
            </h5>
          </div>

          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">Cras justo odio</li>
                <li class="list-group-item">Dapibus ac facilisis in</li>
                <li class="list-group-item">Vestibulum at eros</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="card border-info  mb-2">
          <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="false" aria-controls="collapseTwo">
                Collapsible Group Item #2
              </button>
            </h5>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">Cras justo odio</li>
                <li class="list-group-item">Dapibus ac facilisis in</li>
                <li class="list-group-item">Vestibulum at eros</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="card border-info mb-2">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"
                aria-expanded="false" aria-controls="collapseThree">
                Collapsible Group Item #3
              </button>
            </h5>
          </div>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">Cras justo odio</li>
                <li class="list-group-item">Dapibus ac facilisis in</li>
                <li class="list-group-item">Vestibulum at eros</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="card border-info  my-4">
        <div class="card-header">Write a review</div>
        <div class="card-body">
          <a href="#" class="btn btn-success btn-block">Give us your feedback</a>
        </div>
        </div>
      </div>
    </div>

    </div>

    

  </div>
</div>


@endsection