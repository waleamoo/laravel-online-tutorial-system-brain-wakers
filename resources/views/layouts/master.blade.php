<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ URL::to('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://raw.githubusercontent.com/daneden/animate.css/master/animate.css">
    <link rel="stylesheet" href="{{ URL::to('css/bootnavbar.css')}}">
    <link rel="stylesheet" href="{{ URL::to('css/custom.css')}}">
    <link rel="stylesheet" href="{{ URL::to('css/font-awesome.min.css')}}">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Brain- Wakers">
</head>

<body oncontextmenu="return false;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="main_navbar">
        <a class="navbar-brand" href="/">Brain Wakers</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <!--
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>-->

                <li class="nav-item active">
                    <a class="nav-link" href="#">Services</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="#">Contact</a>
                </li>


                <li class="nav-item dropdown active mr-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Popular Subjects
                    </a>
                
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php $subjects = \App\Subject::all(); ?>
                        @foreach ($subjects as $subject)
                        <li class="nav-item dropdown">
                            <a class="dropdown-item dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                {{ $subject->subject_name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                <?php $courses = \App\Course::where('subject_id', $subject->id)->get(); ?>
                                @foreach ($courses as $crs)
                                <li><a class="dropdown-item" href="{{ route('getCourse', ['cid' => $crs->id]) }}">{{ $crs->course_name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach


                        <!--
                        <li class="nav-item dropdown">
                            <a class="dropdown-item dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                            </ul>
                        </li> -->


                    </ul>
                </li>

                @if(Auth::check())
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('user.course') }}">My Courses</a>
                </li>
                @endif

                <form class="form-inline my-2 my-lg-0" action="{{ route('course.search') }}" method="POST">
                    <input class="typeahead form-control mr-sm-2" type="search" name="search" id="search" aria-label="Search" placeholder="Search any subject">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                    {{ csrf_field() }}
                </form>

            </ul>
            

            <ul class="nav navbar-nav navbar-right ml-4">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('user.cart') }}">
                        <span style="font-size: 1.25em; margin-right: 10px;">
                            <span class="badge badge-danger">{{ Session::has('cart') ? Session::get('cart')->totalQty : '0' }} </span>
                            <i class="fa fas fa-shopping-cart"></i>
                        </span>
                    </a>
                </li>

                @if(Auth::guest())
                <li class="nav-item log-in-btn text-dark">
                    <a class="nav-link text-dark" href="{{ route('user.login') }}">Log In</a>
                </li>

                <li class="nav-item sign-up-btn">
                    <a class="nav-link text-white" href="{{ route('user.register') }}">Sign Up</a>
                </li>
                
                @else
                <li class="nav-item dropdown active hidden-md-down">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Hello {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">User Profile</a>
                        <a class="dropdown-item" href="#">My Courses</a>
                        <a class="dropdown-item" href="#">Cart</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a>
                    </ul>
                </li>
                @endif
            </ul>


        </div>
    </nav>

    @yield('content')
    
    <footer>
        <p class="copyright">
            Brain Wakers &bull; Copyright &copy; <?php echo date('Y'); ?> Brain Wakers, Inc.
        </p>

        <p class="terms">
            <a href="#">Terms</a> | <a href="#">Privacy Policy</a> | <a href="#">Join Brain Wakers</a>
        </p>
    </footer>
    
    <script src="{{ URL::to('js/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="{{ URL::to('js/bootstrap.min.js')}}"></script>
    <script src="{{ URL::to('js/bootnavbar.js')}}" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script>
        $(function () {
            $('#main_navbar').bootnavbar();
        })
    </script>

    <script type="text/javascript">
        var path = "{{ route('autocomplete') }}";
        $('input.typeahead').typeahead({
            source: function (query, process){
                return $.get(path, {query: query}, function(data){
                    return process(data);
                })
            }
        });
    </script>
</body>
</html>

{{-- <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Popular Subjects
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <div class="dropdown-divider"></div>
                        <li></li><a class="dropdown-item" href="#">Something else here</a></li>
                        <li class="nav-item dropdown">
                                <a class="dropdown-item dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Dropdown
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <div class="dropdown-divider"></div>
                                    <li></li><a class="dropdown-item" href="#">Something else here</a></li>
                                    <li class="nav-item dropdown">
                                            <a class="dropdown-item dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                Dropdown
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                                <li><a class="dropdown-item" href="#">Action</a></li>
                                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                                <div class="dropdown-divider"></div>
                                                <li></li><a class="dropdown-item" href="#">Something else here</a></li>
                                            </ul>
                                        </li>
                                </ul>
                            </li>
                    </ul>
                </li> --}}