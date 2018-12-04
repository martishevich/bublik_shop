@extends('layout')

@section('content')

    <!-- cart-main-area start -->
    <div class="cart-main-area ptb--120 bg__white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
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
                                <?php foreach ($data as $v): ?>
                                <tr>
                                    @csrf
                                    <td class="product-name"><a href="#"><?php echo $v['name'] ?></a></td>
                                    <td class="product-price"><span class="amount"><?php echo $v['price'] ?></span></td>
                                    <td class="product-quantity">
                                        <form action="/Cardshop" method="get">
                                            <input type="number" name="quantity" value="<?php echo $v['quantity'] ?>" />
                                        </form>
                                    </td>
                                    <td class="product-subtotal"><?php echo $v['price']*$v['quantity'] ?></td>
                                    <?php $total = $total + $v['price']*$v['quantity'] ?>
                                </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>

    </div>

@endsection