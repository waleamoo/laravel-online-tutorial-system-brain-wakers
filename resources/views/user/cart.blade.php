@extends('layouts.master')

@section('title')
Brain Wakers | Cart
@endsection

@section('content')
<div class="container">

    @if (Session::has('cart'))
    <div class="row">
        <div class="col-md-8 mt-4 offset-md-2" style="margin-bottom: 10rem;">

            <div class="card">
                <div class="card-header">Your Cart</div>
                <div class="card-body">
                    <div class="card-title">Your have the following item(s) in your cart</div>
                    <div class="row">
                        <div class="col"><b>Name</b></div>
                        <div class="col"><b>Price</b></div>
                        
                        <div class="col">&nbsp;</div>
                    </div>

                    @foreach ($courses as $product)
                    <div class="row">
                        <div class="col">{{ $product['item']['course_name']}} {{ \App\Subject::find($product['item']['id'])->value('subject_name') }} Course</div>
                            <div class="col">₦{{ $product['price'] }}.00</div>
                            <div class="col"><a href="{{ route('getRemoveCourse', ['id' => $product['item']['id']]) }}"><i class="fa fas fa-trash delete fa-2x" title="Remove Course"></i></a></div>
                        </div>
                    @endforeach
                    

                    <div class="card-footer">
                        <div class="row" style="float:right; padding: 10px;">
                            <span class="text-white" style="font-size: 1rem;">Total: ₦{{ $totalPrice }}.00</span>
                        </div>
                        <div class="row" style="float:right; clear:right; padding: 10px;">
                            <a href="{{ route('getCheckout')}}" class="btn btn-success btn-sm">Checkout Cart</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @else
    <div class="row">
        <div class="col-md-10 offset-md-1 mt-4">
        <img src="{{ URL::to('images/empty-cart.png') }}" alt="Empty Cart" class="img-responsive">
            <h2 class="display-4">No course added.</h2>
        </div>
    </div>
    @endif

    


</div>
@endsection