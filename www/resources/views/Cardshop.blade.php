@extends('layout')

@section('content')

<!-- cart-main-area start -->
<div class="cart-main-area ptb--120 bg__white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form action="#">
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
                                    <?php $total = 0 ?>
                                    <?php foreach ($orderItems as $v): ?>
                                    <tr>
                                        <td class="product-name"><a href="#"><?php echo $v['name'] ?></a></td>
                                        <td class="product-price"><span class="amount"><?php echo $v['price'] ?></span></td>
                                        <td class="product-quantity"><input type="number" name="quantity" value="<?php echo $v['count'] ?>" /></td>
                                        <td class="product-subtotal"><?php echo $v['price']*$v['count'] ?></td>
                                        <td class="product-remove"><a href="#">X</a></td>
                                        <?php $total = $total + $v['price']*$v['count'] ?>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-7 col-xs-12">
                                <div class="buttons-cart">
                                    <input type="submit" value="Update Cart" />
                                    <a href="/">Continue Shopping</a>
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
                            <form action="/vallidate" method="post">
                            @csrf
                            <div>
                                <h1 style="text-align: center;">Delivery</h1>
                                <br>
                            </div>
                            @include('errors')
                            <div>
                                <h2>Full Name</h2>
                                <input type="text" placeholder="Enter Your Full Name" name="FullName" value="{{ old('FullName') }}">
                                <br>
                            </div>
                            <div>
                                <h2>Phone Number</h2><h3> please, enter your phone number like "<strong>375</strong>123456789" </h3>
                                <input type="text" placeholder="Enter Your Phone Number" name="PhoneNumber" value="{{ old('PhoneNumber') }}" pattern = "^\d+$">
                                <br>
                            </div>
                            <div>
                                <h2>Email</h2>
                                <input type="email" id="" placeholder="Enter Your Email" name="Email" value="{{ old('Email') }}">
                                <br>
                            </div>
                            <div>
                                <h2>Adress:</h2><h3> please, enter your adress like "street/home/apatment/floor" </h3>
                                <input type="text" placeholder="Enter Your Adress" name="Adress" value="{{ old('Adress') }}">
                                <br>
                            </div>
                            <div>
                                <h2>Comment</h2>
                                <input type="text" name="comment" value="{{ old('comment') }}">
                                <br>
                            </div>
                            
                            <div>
                                <br>
                                <input type="submit" class="btn btn-info" value="Send"> 
                            </div>
                            </form>

                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    <!-- cart-main-area end -->

    </div>

@endsection