@extends('layout')

@section('content')

<!-- Start Product Details -->
    <section class="htc__product__details pt--100 pb--100 bg__white">
        <div class="container">
            <div class="scroll-active">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                        <div class="product__details__container product-details-5">
                            <div class="scroll-single-product mb--30">
                                <img src="images/Products/prod1.jpg" alt="full-image">
                            </div>
                            <div class="scroll-single-product mb--30">
                                <img src="images/Products/prod1.jpg" alt="full-image">
                            </div>
                            <div class="scroll-single-product mb--30">
                                <img src="images/Products/prod1.jpg" alt="full-image">
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-active col-md-6 col-lg-6 col-sm-6 col-xs-12 xmt-30">
                        <div class="htc__product__details__inner ">
                            <div class="pro__detl__title">
                                <h2>{{ $prodDet["name"] }}</h2>
                            </div> 
                            <div class="pro__details">
                                <p>{{ $prodDet["description"] }}</p>
                            </div>
                            <ul class="pro__dtl__prize">
                                <li>{{ $prodDet["price"] }}</li>
                            </ul>
                            <ul class="pro__dtl__btn">
                                <li class="buy__now__btn">
                                    <div col-md-6 col-lg-6 col-sm-6 col-xs-12>
                                        <form action="/product_details/{{ $id }}" method="post">
                                            @csrf
                                                <input type="number" name="quantity" value="{{ $quantity }}" class="btn btn-primary-succes">
                                                <input type="submit" class="btn btn-primary-succes" name="ADD" value="ADD TO CART">
                                        </form>
                                    </div>
                                </li>
                            </ul>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- End Product Details -->   

@endsection