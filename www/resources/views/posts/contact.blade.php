@extends('layout')

@section('content')
    <section class="htc__contact__area ptb--120 bg__white">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <div class="htc__contact__container">
                        <div class="htc__contact__address">
                            <h2 class="contact__title">contact info</h2>
                            <div class="contact__address__inner">
                                <!-- Start Single Adress -->
                                <div class="single__contact__address">
                                    <div class="contact__icon">
                                        <span class="ti-mobile"></span>
                                    </div>
                                    <div class="contact__details">
                                        <p> Phone : <br><a href="tel:+375292044640">+375 (29) 204-46-40 (MTC)</a></p>
                                    </div>
                                </div>
                                <!-- End Single Adress -->
                                <!-- Start Single Adress -->
                                <div class="single__contact__address">
                                    <div class="contact__icon">
                                        <span class="ti-email"></span>
                                    </div>
                                    <div class="contact__details">
                                        <p> Mail :<br><a href="mailto:loliabombita@mail.ru">loliabombita@mail.ru</a></p>
                                    </div>
                                </div>
                                <!-- End Single Adress -->
                            </div>
                        </div>
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="contact-form-wrap">
                            <div class="contact-title">
                                <h2 class="contact__title">Get In Touch</h2>
                            </div>
                            {!!Form::open(['route'=>'contact.add_contact', 'method'=>'POST', 'accept-charset'=>'UTF-8']) !!}
                            {!!Form::label('name','Your name', ['id'=>'','class'=>'']) !!}
                            {!!Form::text('name','',['id'=>'','class'=>'']) !!}
                            {!!Form::label('email','Email',['id'=>'','class'=>'']) !!}
                            {!!Form::email('email','',['id'=>'','class'=>'']) !!}
                            {!!Form::label('phone','Phone number', ['id'=>'','class'=>'']) !!}
                            {!!Form::text('phone','',['id'=>'','class'=>'']) !!}
                            {!!Form::label('subject','Subject', ['id'=>'','class'=>'']) !!}
                            {!!Form::text('subject','',['id'=>'','class'=>'']) !!}
                            {!!Form::label('message','Message',['id'=>'','class'=>'']) !!}
                            {!!Form::textarea('message','',['id'=>'','class'=>''])!!}
                            {!!Form::submit('Send') !!}
                            {{ Form::close() }}
                        </div>
                        <div class="form-output">
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 smt-30 xmt-30">
                    <div class="map-contacts">
                        <div id="googleMap"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact Area -->
@endsection