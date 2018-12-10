@extends('layout')
@section('content')
    <div class="container">
        <h1 style="text-align: center">
            Your order accept!
            <br><br><br>
        </h1>
        <h2 style="text-align: justify">Send you email with check?
            <br><br>
        </h2>
        {!!Form::open(['action'=>'AddToOrderController@viewOrder', 'method'=>'POST', 'accept-charset'=>'UTF-8']) !!}
        {!!Form::hidden('id',$s['order_id']) !!}
        {!!Form::submit('Send') !!}
        {{ Form::close() }}
    </div>

@endsection