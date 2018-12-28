@extends('layout')

@section('content')
    <div class="body__overlay"></div>
    <!-- Start Offset Wrapper -->
    <div class="offset__wrapper">
        <!-- Start Search Popap -->
        <div class="search__area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="search__inner">
                            <form action="#" method="get">
                                <input placeholder="Search here... " type="text">
                                <button type="submit"></button>
                            </form>
                            <div class="search__close__btn">
                                <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                <ul class="nav nav-pills nav-stacked">
                                    <?php foreach ($catTitle as $title): ?>
                                    <li class="<?if ($id == $title['id']) {
                                        echo "active";
                                    }?>">
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
                            @if (!empty($categories[0]))
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
                                            <a href="/product_details/<?php echo $v->id ?>" role="button">
                                                <p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: green; font-size: 16px; text-transform: capitalize;">
                                                    <?php echo $v->name ?>
                                                </p>

                                                <p style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis; font-size: 12px">
                                                    <?php echo $v->short_disc ?>
                                                </p>

                                                <p style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis; color: red;">
                                                    <?php echo $v->price ?>
                                                </p>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <!-- End Single Product -->
                        </div>
                    </div>
                </div>
                <div align="center">{{$categories->links()}}</div>
                @else
                    <div class = "container">
                        <h1 style="text-align: left">
                            No products in this category ;(
                        </h1>
                    </div>
                    @endif
            </div>
        </div>
    </section>
    <!-- End Feature Product -->

@endsection
