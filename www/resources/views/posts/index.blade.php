@extends('layout')

@section('content')
    <div class="body__overlay"></div>
    <!-- Start Offset Wrapper -->
    <div class="offset__wrapper">
        <!-- Start Search Popap -->
        <div class="search__inner">
            <form action="{{route('searchSimple')}}" method="GET" class="search-simple">
                <div class="row">
                    <div class="col-xs-10">
                        <div class="form-group">
                            <input type="text" class="form-control" name="q" value="{{ old('q') }}" required>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="form-group">
                            <input class="btn btn-info" type="submit" value="Искать">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- End Search Popap -->
        <!-- Start Offset MEnu -->
        <div class="offsetmenu">
            <div class="offsetmenu__inner">
                <div class="offsetmenu__close__btn">
                    <a href="#"><i class="zmdi zmdi-close"></i></a>
                </div>
                <div class="off__contact">
                    <div class="logo">
                        <a href="index.html">
                            <img src="images/logo/logo.png" alt="logo">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Offset MEnu -->
        <!-- Start Cart Panel -->
        <div class="shopping__cart">
            <div class="shopping__cart__inner">
                <div class="offsetmenu__close__btn">
                    <a href="#"><i class="zmdi zmdi-close"></i></a>
                </div>
                <div class="shp__cart__wrap">
                    <div class="shp__single__product">
                        <div class="shp__pro__thumb">
                            <a href="#">
                                <img src="images/product/sm-img/1.jpg" alt="product images">
                            </a>
                        </div>
                        <div class="shp__pro__details">
                            <h2><a href="product-details.html">BO&Play Wireless Speaker</a></h2>
                            <span class="quantity">QTY: 1</span>
                            <span class="shp__price">$105.00</span>
                        </div>
                        <div class="remove__btn">
                            <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                        </div>
                    </div>
                    <div class="shp__single__product">
                        <div class="shp__pro__thumb">
                            <a href="#">
                                <img src="images/product/sm-img/2.jpg" alt="product images">
                            </a>
                        </div>
                        <div class="shp__pro__details">
                            <h2><a href="product-details.html">Brone Candle</a></h2>
                            <span class="quantity">QTY: 1</span>
                            <span class="shp__price">$25.00</span>
                        </div>
                        <div class="remove__btn">
                            <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                        </div>
                    </div>
                </div>
                <ul class="shoping__total">
                    <li class="subtotal">Subtotal:</li>
                    <li class="total__price">$130.00</li>
                </ul>
                <ul class="shopping__btn">
                    <li><a href="cart.html">View Cart</a></li>
                    <li class="shp__checkout"><a href="checkout.html">Checkout</a></li>
                </ul>

            </div>

        </div>
        <!-- End Cart Panel -->
    </div>
    <!-- End Offset Wrapper -->
    <!-- Start Feature Product -->
    <section class="categories-slider-area bg__white">
        <div class="container">
            <div class="row">
                <div class="container">
                    <div class="col-md-3 col-lg-3 col-sm-4 col-xs-12">
                        <div class="categories-menu mrg-xs">
                            <div class="category-heading">
                                <h3>Categories</h3>
                            </div>
                            <div class="category-menu-list">
                                <ul>
                                    <?php foreach ($catTitle as $title): ?>
                                    <li>
                                        <a href="/categories/<?php echo $title['id']?>"> <?php echo $title['title']?></a>
                                    </li>
                                    <?php endforeach;?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Left Feature -->
                    <!-- Start Single Product -->
                    <div class="col-md-9 col-lg-9 col-sm-8 col-xs-12 row justify-content">
                        <div class="product__list another-product-style">

                            <?php foreach ($product as $k => $v): ?>
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
                                                    <form action="/" method="get">

                                                        <input type="hidden" name="prodid" value="<?php echo $n ?>">
                                                        <input type="submit" class="btn btn-dark btn-sm" value="Basket">

                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product__hover__info">
                                        <ul class="product__action">
                                            <li>
                                                <form action="/" method="post" >
                                                            <input type="hidden" name="prodid" value="<?php echo $n ?>">
                                                            <button class="ti-shopping-cart btn btn-light"></button>
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
                        <?php endforeach; ?>
                        <!-- End Single Product -->
                        </div>
                    </div>
                    <div align="center">{{$product->links()}}</div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Feature Product -->

@endsection
