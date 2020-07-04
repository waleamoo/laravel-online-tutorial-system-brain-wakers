@extends('layouts.master')

@section('title')
Brain Wakers | Classroom
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 mt-4">
      <!-- chuck course 2 per row -->
      <div class="row">
        <div class="row" style="position: relative;">
          <!--<div class="yt-cover"></div>-->
          <iframe width="750" height="470" src="https://www.youtube.com/embed/SFhbnx4qovw?autoplay=1" frameborder="3"></iframe>
        <!-- <iframe id="ytplayer" type="text/html" width="640" height="360"
  src="https://www.youtube.com/embed/M7lc1UVf-VE?autoplay=1&origin=http://example.com"
  frameborder="0"></iframe> -->
        </div>

        <section class="comments">
          <div class="row">
            <div class="card" style="width: 100%;">
              <div class="card-body">
                <textarea class="form-control" name="comment" id="comment" cols="30" rows="5"></textarea>
              </div>
              <div class="card-footer">
                <button type="button" class="btn btn-success float-right">Submit Comment</button>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="card w-50">
              <div class="card-body">
                This is the comment made by a user
              </div>
              <div class="card-footer text-muted text-sm-right font-italic">
                On January 01 2020 13:55PM
              </div>
            </div>
          </div>
          <br>

          <div class="row float-right">
            <div class="card">
              <div class="card-body">
                This is the comment made by a user. This comment is a reply by a user
              </div>
              <div class="card-footer text-muted text-sm-right font-italic">
                On January 01 2020 13:55PM
              </div>
            </div>
          </div>
        </section>

      </div>
    </div>

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
    </div>

  </div>
</div>


@endsection