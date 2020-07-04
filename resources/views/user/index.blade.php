@extends('layouts.master')

@section('title')
Brain Wakers | Home
@endsection

@section('content')
<div class="container">
  <section class="header-section">
    <img class="img-responsive img-thumbnail" src="{{ URL::to('images/e-learn.jpg') }}" alt="e-learning" width="100%">

    <div class="header-text">
      <h1>Learn from home</h1>
      <p>No school? No problem.</p>

      <form action="{{ route('course.search') }}" method="POST">
      <div class="input-group mb-3 col-md-8 col-sm-12">
          <input type="text" class="typeahead form-control" name="search" id="search" placeholder="Search any subject"
            aria-label="Username" aria-describedby="basic-addon1">
          <div class="input-group-append">
            <span class="input-group-text" id="basic-addon1"><i class="fa fas fa-search"></i></span>
          </div>
          {{ csrf_field() }}
      </div>
    </form>

    </div>

  </section>
  <hr>
  <section class="welcome">
    <div class="container">
      <p class="text-white-50 welcome-text">
        <span style="font-size: 200%; color: red;">B</span>rain wakers, a subsidiary of Well-Informed Technologies is
        the
        provider of quality home school services in West Africa. We use the best technologies and instructional
        materials
        to provide learning almost better than it is offered in schools. Our goal is to give everyone a chance at
        education
        irrespective of your distance, daily work schedule, or work routine using the best means of coverage, the
        internet.
      </p>
    </div>
  </section>

  <section class="benefits">
    <div class="container">
      <h2>Benefits </h2>
      <div class="row">
        <div class="col-md-4 ">
          <div class="card border-info mb-3">
            <div class="card-body">
              <h5 class="card-title text-capitalize">Own your class room</h5>
              <p class="card-text text-white">Some quick exke up the bulk of the card's content.</p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card border-info mb-3">
            <div class="card-body">
              <h5 class="card-title text-capitalize">Be In Control</h5>
              <p class="card-text text-white">Some quick exke up the bulk of the card's content.</p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card border-info mb-3">
            <div class="card-body">
              <h5 class="card-title text-capitalize">Learn anytime, anywhere</h5>
              <p class="card-text text-white">Some quick exke up the bulk of the card's content.</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="reviews">
    <div class="container">
      <h2>What our students are saying</h2>
      <hr>
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <!-- slider 1 -->
          <div class="carousel-item active">
            <div class="row">

              <div class="col-md-4">
                <div class="card border-info mb-3 bg-white">
                  <div class="card-body">
                    <img src="{{ URL::to('images/unknown.png') }}" alt="Student"
                      class="img-responsive w-25 align-content-md-start">
                    <h5 class="card-title text-capitalize text-dark-50">John Doe</h5>
                    <p class="card-text text-dark-50">Some quick exke up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="card border-info mb-3 bg-white">
                  <div class="card-body">
                    <img src="{{ URL::to('images/unknown.png') }}" alt="Student"
                      class="img-responsive w-25 align-content-md-start">
                    <h5 class="card-title text-capitalize text-dark-50">John Doe</h5>
                    <p class="card-text text-dark-50">Some quick exke up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="card border-info mb-3 bg-white">
                  <div class="card-body">
                    <img src="{{ URL::to('images/unknown.png') }}" alt="Student"
                      class="img-responsive w-25 align-content-md-start">
                    <h5 class="card-title text-capitalize text-dark-50">John Doe</h5>
                    <p class="card-text text-dark-50">Some quick exke up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end of slider 1-->
          <!-- slider 2-->
          <div class="carousel-item">
            <div class="row">

              <div class="col-md-4">
                <div class="card border-info mb-3 bg-white">
                  <div class="card-body">
                    <img src="{{ URL::to('images/unknown.png') }}" alt="Student"
                      class="img-responsive w-25 align-content-md-start">
                    <h5 class="card-title text-capitalize text-dark-50">John Doe</h5>
                    <p class="card-text text-dark-50">Some quick exke up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="card border-info mb-3 bg-white">
                  <div class="card-body">
                    <img src="{{ URL::to('images/unknown.png') }}" alt="Student"
                      class="img-responsive w-25 align-content-md-start">
                    <h5 class="card-title text-capitalize text-dark-50">John Doe</h5>
                    <p class="card-text text-dark-50">Some quick exke up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="card border-info mb-3 bg-white">
                  <div class="card-body">
                    <img src="{{ URL::to('images/unknown.png') }}" alt="Student"
                      class="img-responsive w-25 align-content-md-start">
                    <h5 class="card-title text-capitalize text-dark-50">John Doe</h5>
                    <p class="card-text text-dark-50">Some quick exke up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end of slider 2-->

          <!-- slider 3-->
          <div class="carousel-item">
            <div class="row">

              <div class="col-md-4">
                <div class="card border-info mb-3 bg-white">
                  <div class="card-body">
                    <img src="{{ URL::to('images/unknown.png') }}" alt="Student"
                      class="img-responsive w-25 align-content-md-start">
                    <h5 class="card-title text-capitalize text-dark-50">John Doe</h5>
                    <p class="card-text text-dark-50">Some quick exke up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="card border-info mb-3 bg-white">
                  <div class="card-body">
                    <img src="{{ URL::to('images/unknown.png') }}" alt="Student"
                      class="img-responsive w-25 align-content-md-start">
                    <h5 class="card-title text-capitalize text-dark-50">John Doe</h5>
                    <p class="card-text text-dark-50">Some quick exke up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="card border-info mb-3 bg-white">
                  <div class="card-body">
                    <img src="{{ URL::to('images/unknown.png') }}" alt="Student"
                      class="img-responsive w-25 align-content-md-start">
                    <h5 class="card-title text-capitalize text-dark-50">John Doe</h5>
                    <p class="card-text text-dark-50">Some quick exke up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end of slider 3-->
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"
            style="height: 30px; width: 20px; color: black;"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true" style="height: 30px; width: 20px;"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

    </div>

  </section>
</div>

<!-- 

  <div class="row">

                    <div class="col-md-4">
                      <div class="card border-info mb-3 bg-white">
                          <div class="card-body">
                            <img src="{{ URL::to('images/unknown.png') }}" alt="Student" class="img-responsive w-25 align-content-md-start">
                            <h5 class="card-title text-capitalize text-dark-50">John Doe</h5>
                            <p class="card-text text-dark-50">Some quick exke up the bulk of the card's content.</p>
                          </div>
                        </div>
                  </div>

                  <div class="col-md-4">
                    <div class="card border-info mb-3 bg-white">
                        <div class="card-body">
                          <img src="{{ URL::to('images/unknown.png') }}" alt="Student" class="img-responsive w-25 align-content-md-start">
                          <h5 class="card-title text-capitalize text-dark-50">John Doe</h5>
                          <p class="card-text text-dark-50">Some quick exke up the bulk of the card's content.</p>
                        </div>
                      </div>
                </div>

                <div class="col-md-4">
                  <div class="card border-info mb-3 bg-white">
                      <div class="card-body">
                        <img src="{{ URL::to('images/unknown.png') }}" alt="Student" class="img-responsive w-25 align-content-md-start">
                        <h5 class="card-title text-capitalize text-dark-50">John Doe</h5>
                        <p class="card-text text-dark-50">Some quick exke up the bulk of the card's content.</p>
                      </div>
                    </div>
              </div>
                  </div>
-->
@endsection