@extends('layout')
@section('content')
    <div style="min-height: 500px">
    <div class="container">
        <h1 style="text-align: center">
            Hello, <?= $order->fullname?>!
        </h1>
        <br><br>
        <p> Your order № <?= $order->id?> is accepted for processing. If you have questions or have noticed an error in
            the order, please contact us. Our
            phone: <a href="tel:+375297000000">+375(29)700-00-00</a>,
            email: <a href="mailto:info@bublik.com">info@bublik.com</a>.
        </p>
    </div>
    </div>
@endsection