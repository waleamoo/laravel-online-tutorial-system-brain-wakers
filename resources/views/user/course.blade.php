@extends('layouts.master')

@section('title')
Brain Wakers | Course 
@endsection

@section('content')
<div class="container">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3>My Course(s)</h3>

                <!-- chuck course 2 per row -->
                <div class="row">
                    <div class="card border-info m-3" style="max-width: 20rem;">
                        <h5 class="card-header text-capitalize">Course Name</h5>
                        <div class="card-body">
                          <p class="card-text text-white">Some quick exke up the bulk of the card's content.</p>
                        <a href="{{ route('user.classroom')}}" class="btn btn-primary">Go to Course</a>
                        </div>
                      </div>
    
                      <div class="card border-info m-3" style="max-width: 20rem;">
                        <h5 class="card-header text-capitalize">Course Name</h5>
                        <div class="card-body">
                          <p class="card-text text-white">Some quick exke up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go to Course</a>
                        </div>
                      </div>
                </div>


            </div>
    
            @include('include.side')
        </div>
        

    </div>
</div>
@endsection