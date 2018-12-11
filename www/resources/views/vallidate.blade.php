@extends('layout')

@section('content')

            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="table-content table-responsive">
                            <table>
                            <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">SubTotal</th>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php $total = 0 ?>
                                    <?php foreach ($orderItems as $v): ?>
                                    <tr>
                                        <td class="product-name"><?php echo $v['name'] ?></td>
                                        <td class="product-price"><span class="amount"><?php echo $v['price'] ?></span></td>
                                        <td class="product-quantity">
                                                <input type="number" name="quantity" value="<?php echo $v['count'] ?>">
                                        </td>
                                        <td class="product-subtotal"><?php echo $v['price']*$v['count'] ?></td>
                                        <?php $total = $total + $v['price']*$v['count']; ?>
                                    </tr>
                                    
                                    <?php endforeach; ?>                                    
                            </tbody>
                            </table>
                            <div style="text-align: right;" class="col-md-12 col-sm-12 col-xs-12">
                            <h1>TOTAL</h1>
                            <h2 style="color:red;"><?php echo $total ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="table-content table-responsive">
                            <table>
                            <thead>
                                    <tr>
                                        <th class="product-name">FullName</th>
                                        <th class="product-price">PhoneNumber</th>
                                        <th class="product-quantity">Email</th>
                                        <th class="product-subtotal">Adress</th>
                                    </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td class="product-name"><?php echo $post['fullname'] ?></td>
                                        <td class="product-price"><span class="amount"><?php echo $post['phonenumber'] ?></span></td>
                                        <td class="product-quantity"><?php echo $post['email'] ?></td>
                                        <td class="product-subtotal"><?php echo $post['adress'] ?></td>
                                    </tr>
                                    
                            </tbody>
                            </table>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <form action="Cardshop" method="post">
                                    <span><button type="button" class="btn btn-primary btn-lg btn-block">Go Back </button>
                                    <button type="button" class="btn btn-primary btn-lg btn-block">Let Go</button></span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection