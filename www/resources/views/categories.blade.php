@extends('layout')






@section('content')
    !-- Start Feature Product -->
    <section class="categories-slider-area bg__white">
        <div class="container">
            <div class="row">
                <div class="container">
                    <div class="col-md-9 col-lg-9 col-sm-8 col-xs-12 row justify-content">
                        <div class="product__list another-product-style">

                            <?php foreach ($categories as $k => $v): ?>
                            <?php $n = $v->id; ?>
                            <div class="col-md-3 col-lg-3 col-sm-8 col-xs-12 no-gutters row justify-content">
                                <div class="product foo">
                                    <div class="product__inner">
                                        <div class="pro__thumb">
                                            <a href="#">
                                                <img src="images/Products/prod1.jpg" alt="product images">
                                            </a>
                                        </div>
                                        <div class="product__hover__info">
                                            <ul class="product__action">
                                                <li><a data-toggle="modal" data-target="#productModal"
                                                       title="Quick View" class="quick-view modal-view detail-link"
                                                       href="#"><span class="ti-plus"></span></a></li>
                                                <li>
                                                    <form action="/" method="post">

                                                        <input type="hidden" name="prodid" value="<?php echo $n ?>">
                                                        <input type="submit" class="btn btn-dark btn-sm" value="Basket">

                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product__details">
                                        <h2><a href="product-details.html"><?php echo $v->name ?></a></h2>
                                        <h2><?php echo $v->short_disc ?></h2>
                                        <h2><?php echo $v->price ?></h2>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!-- End Single Product -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection