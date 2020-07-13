@extends('layouts.master')

@section('title')
Brain Wakers | Review
@endsection

@section('content')
<div class="container">
    <div class="container">
        <div class="row my-4">
            
            <div class="col-lg-8 col-sm-8 mb-4">
                <div class="card">
                    <div class="card-header">
                        Write a Review
                    </div>
                    <div class="card-body">
                        
                        @include('include.message')
                        <form action="{{ route('user.review') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="rating" id="rating" value="">

                            <div class="form-group">
                                <label for="name">Name</label>
                            <input type="text" value="{{ Auth::user()->name }}" class="form-control" id="name" name="name" placeholder="Name" readonly>
                            </div>

                            <div class="form-group">
                                <label for="msg">Review</label>
                                <textarea class="form-control" name="review" id="msg" cols="30" rows="10" placeholder="Your message..">{{ old('message')}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="picture">Your Picture</label>
                                <input type="file" class="form-control form-control-file" name="picture" id="picture">
                            </div>

                            <div class='rating-stars text-center'>
                                <ul id='stars'>
                                    <li class='star' title='Poor' data-value='1'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='Fair' data-value='2'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='Good' data-value='3'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='Excellent' data-value='4'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='WOW!!!' data-value='5'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                </ul>
                            </div>
    
                            <button type="submit" class="btn btn-success btn-lg">Send Review</button>
                        </form>
    
                    </div>
                </div>
    
            </div>


        </div>


    </div>
</div>
@endsection
