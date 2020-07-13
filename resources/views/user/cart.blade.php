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
                        <div class="col">{{ $product['item']['course_name']}} {{ \App\Subject::find($product['item']['subject_id'])->value('subject_name') }}  Course</div>
                            <div class="col">₦{{ $product['price'] }}.00</div>
                            <div class="col"><a href="{{ route('getRemoveCourse', ['id' => $product['item']['id']]) }}"><i class="fa fas fa-trash delete fa-2x" title="Remove Course"></i></a></div>
                        </div>
                    @endforeach
                    <br><br>

                    <div class="card-footer">
                        <div class="row" style="float:right; padding: 10px;">
                            <span class="text-white" style="font-size: 1rem;">Total: ₦{{ $totalPrice }}.00</span>
                        </div>
                        <div class="row" style="float:right; clear:right; padding: 10px;">
                            <script src="//voguepay.com/js/voguepay.js"></script> 
                            <form action="https://voguepay.com/pay/" method="POST">
                                
                                <input name="v_merchant_id" type="hidden" value="demo" />
                                <input name="memo" type="hidden" value="Brain Wakers Tutorial" />
                                <input name="success_url" type="hidden" value="{{ url('/f&bm&jgf&hjfhh&hfhghtzfgturfeuwh&vfdbssguiuewfhdje&rbnvihrslcnuiwbuvrcbicrkuhvtrikujesbxxusx') }}" />
                                <input name="fail_url" type="hidden" value="{{ url('/') }}" />
                                <input src="https://voguepay.com/images/buttons/checkout_green.png" type="image" />
                                <input name="merchant_ref" type="hidden" value="Tutorial Payment" />
                                <input name="developer_code" type="hidden" value="5e15148f0446e" />
                                <input name="store_id" type="hidden" value="4895" />
                                <input name="cur" type="hidden" value="NGN" />
                                <input name="item_1" type="hidden" value="Brain Wakers Tutorial" />
                                <input name="price_1" type="hidden" value="{{ $totalPrice }}" />
                                <input name="description_1" type="hidden" value="Brain Wakers Tutorial Payment" />
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            </form>

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