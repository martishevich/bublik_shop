@extends('layout')
@section('content')
    <!-- cart-main-area start -->
    <div class="cart-main-area ptb--120 bg__white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form action="/Cardshop" method="post">
                        @csrf
                        <?php $total = 0; $quantityId = 0 ?>
                        <?php if (session('counter') > 0) { ?>
                        <div class="table-content table-responsive">
                            <table>

                                <thead>
                                <tr>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($orderItems as $v): ?>
                                <tr>

                                    <td class="product-name"><?php echo $v['name'] ?></td>
                                    <td class="product-price"><span class="amount"><?php echo $v['price'] ?></span></td>
                                    <td class="product-quantity">
                                        <input type="hidden" name="upid<?php echo $v['id'] ?>"
                                               value="<?php echo $v['id'] ?>">
                                        <input type="number" name="quantity<?php echo $v['id'] ?>"
                                               value="<?php echo $v['count'] ?>"/>
                                    </td>
                                    <td class="product-subtotal"><?php echo $v['price'] * $v['count'] ?></td>
                                    <td class="product-remove">
                                        <form action="/Cardshop" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="<?php echo $v['id'] ?>">
                                            <input type="submit" name="remove" value="X"
                                                   style="background-color: red; color: white;">
                                        </form>
                                    </td>
                                    <?php $total = $total + $v['price'] * $v['count']; $quantityId++ ?>
                                </tr>
                                <?php endforeach; ?>

                                </tbody>

                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-7 col-xs-12">
                                <div class="buttons-cart">
                                    <a href="/">Continue Shopping</a>
                                    <input type="hidden" name="Update">
                                    <input type="submit" value="Update" style="background-color: green;"/>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <div class="cart_totals">
                                    <h2>Cart Totals</h2>
                                    <table>
                                        <tbody>
                                        <tr class="order-total">
                                            <th></th>
                                            <td>
                                                <strong><span class="amount"><?php echo $total  ?></span></strong>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="container">
                            <?php if (isset($post)){ ?>

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="/Cardshop" method="post">
                                @csrf
                                <div>
                                    <h1 style="text-align: center;">Delivery</h1>
                                    <br>
                                </div>

                                <div>
                                    <h2>Full Name</h2>
                                    <input type="text" class="form-control" placeholder="Enter Your Full Name"
                                           name="fullname" id="fullname" value="{{ $post['fullname'] }}">
                                    <br>
                                </div>
                                <div>
                                    <h2>Phone Number</h2>
                                    <h3> please, enter your phone number like "<strong>375</strong>123456789" </h3>
                                    <input type="text" placeholder="Enter Your Phone Number" class="form-control"
                                           id="phonenumber" name="phonenumber" value="{{ $post['phonenumber'] }}">
                                    <br>
                                </div>
                                <div>
                                    <h2>Email</h2>
                                    <input type="email" id="email" placeholder="Enter Your Email" class="form-control"
                                           name="email" value="{{ $post['email'] }}">
                                    <br>
                                </div>
                                <div>
                                    <h2>Adress:</h2>
                                    <h3> please, enter your adress like "street_home_apatment_floor" </h3>
                                    <input type="text" placeholder="Enter Your Adress" class="form-control"
                                           name="adress" id="adress" value="{{ $post['adress'] }}">
                                    <br>
                                </div>
                                <div>
                                    <h2>Comment</h2>
                                    <input type="text" name="comment" class="form-control"
                                           value="{{ $post['comment'] }}">
                                    <br>
                                </div>
                                <div>
                                    <br>
                                    <input type="submit" class="btn btn-info" value="Send" name="Send">
                                </div>
                            </form>
                            <?php } else { ?>
                            <form action="/Cardshop" method="post">
                                @csrf
                                <div>
                                    <h1 style="text-align: center;">Delivery</h1>
                                    <br>
                                </div>

                                <div>
                                    <h2>Full Name</h2>
                                    <input type="text" class="form-control" placeholder="Enter Your Full Name"
                                           name="fullname" id="fullname" value="">
                                    <br>
                                </div>
                                <div>
                                    <h2>Phone Number</h2>
                                    <h3> please, enter your phone number like "<strong>375</strong>123456789" </h3>
                                    <input type="text" placeholder="Enter Your Phone Number" class="form-control"
                                           id="phonenumber" name="phonenumber" value="">
                                    <br>
                                </div>
                                <div>
                                    <h2>Email</h2>
                                    <input type="email" id="email" placeholder="Enter Your Email" class="form-control"
                                           name="email" value="">
                                    <br>
                                </div>
                                <div>
                                    <h2>Adress:</h2>
                                    <h3> please, enter your adress like "street_home_apatment_floor" </h3>
                                    <input type="text" placeholder="Enter Your Adress" class="form-control"
                                           name="adress" id="adress" value="">
                                    <br>
                                </div>
                                <div>
                                    <h2>Comment</h2>
                                    <input type="text" name="comment" class="form-control" value="">
                                    <br>
                                </div>
                                <div>
                                    <br>
                                    <input type="submit" class="btn btn-info" value="Send" name="Send">
                                </div>
                            </form>
                            <?php }  ?>
                            <?php } else { ?>
                            <div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                                <h1>BASKET ARE EMPTY!<br><br><br><br>
                                    <div class="img">
                                        <img src="images/CardShop.jpg" class="img-fluid" alt="Responsive image">
                                        <br><br><br>
                                    </div>
                                    PLEASE, GO TO SHOP, CHOOSE SOME PRODCUT AND COME BACK
                                </h1>
                                <br><br><br><br>

                            </div>
                            <?php }  ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-main-area end -->

    </div>

@endsection