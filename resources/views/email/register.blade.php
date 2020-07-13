<p>Hi, {{ $name }}</p>
<p>{{ $body }}</p>
<p>Your course(s):</p>
@foreach ($orders as $order)
    @foreach($order->cart->items as $item)
    <p>
        {{ $item['item']['course_name'] }} <?php echo \App\Subject::where('id', $item['item']['subject_id'] )->value('subject_name'); ?>
         Course  at <span class="badge badge-danger"> ₦{{ $item['price'] }}.00</span>
    </p>
    @endforeach
    <strong>Total Price: ₦{{ $order->cart->totalPrice }}.00</strong>
@endforeach
<br>
<br>
<p>Cheers,</p>
<p>The Brain Wakers Team</p>