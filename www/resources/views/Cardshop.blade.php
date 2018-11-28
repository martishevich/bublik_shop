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
                                    <tr>
                                        <td class="product-name"><a href="#">Vestibulum suscipit</a></td>
                                        <td class="product-price"><span class="amount">£165.00</span></td>
                                        <td class="product-quantity"><input type="number" value="1" /></td>
                                        <td class="product-subtotal">£165.00</td>
                                        <td class="product-remove"><a href="#">X</a></td>
                                    </tr>
                                    <tr>
                                        <td class="product-name"><a href="#">Vestibulum dictum magna</a></td>
                                        <td class="product-price"><span class="amount">£50.00</span></td>
                                        <td class="product-quantity"><input type="number" value="1" /></td>
                                        <td class="product-subtotal">£50.00</td>
                                        <td class="product-remove"><a href="#">X</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-7 col-xs-12">
                                <div class="buttons-cart">
                                    <input type="submit" value="Update Cart" />
                                    <a href="#">Continue Shopping</a>
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
                                                    <strong><span class="amount">£215.00</span></strong>
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
                            <form action="/" method="post">
                            @csrf
                            <div>
                                <h1 style="text-align: center;">Delivery</h1>
                                <br>
                            </div>
                            <div>
                                <h2>First Name</h2>
                                <input type="text" placeholder="Enter Your First Name" name="FName">
                                <br>
                            </div>
                            <div>
                                <h2>Second Name</h2>
                                <input type="text" placeholder="Enter Your Second Name" name="SName">
                                <br>
                            </div>
                            <div>
                                <h2>Phone Number</h2>
                                <input type="text" placeholder="Enter Your Phone Number" name="PNumber" >
                                <br>
                            </div>
                            <div>
                                <h2>Email</h2>
                                <input type="email" name="email" id="" placeholder="Enter Your Email" name="Email">
                                <br>
                            </div>
                            <div>
                                <h2>Adress:</h2><h3> please, enter your adress like "street/home/apatment/floor" </h3>
                                <input type="text" placeholder="Enter Your Adress" name="Adress">
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