@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h1 style="text-align: center;">
                    Your order accept!
                    <br><br><br>
                </h1>
                <h2 style="text-align: center;">Send you email with check?
                    <br><br>
                </h2>
            </div>
        </div>
        
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="table-content">
                            <table>
                            <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th >Quantity</th>
                                        <th class="product-subtotal">SubTotal</th>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php $total = 0 ?>
                                    <?php foreach ($orderItems as $v): ?>
                                    <tr>
                                        <td class="product-name"><?php echo $v['name'] ?></td>
                                        <td class="product-price"><span class="amount"><?php echo $v['price'] ?></span></td>
                                        <td>
                                                <?php echo $v['count'] ?>
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
                            <div style="text-align: left;" class="col-md-auto">
                                <form action="/orderList" method="post">
                                    @csrf
                                    <span>
                                        <input type="hidden" name="goback" value="goback">
                                        <button type="submit" class="btn btn-danger" name="goback">
                                        Go Back 
                                        </button>
                                    </span>
                                    <br><br>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12" >
                        <div class="col-md-6 col-sm-6 col-xs-6"  >
                        <ul style="text-align: left; color: green;">
                            <li>FullName</li>
                            <li>PhoneNumber</li>
                            <li>Email</li>
                            <li>Adress</li>
                            
                        </ul>
                        <br><br> <br><br>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6"  >
                        <ul style="text-align: right; color: green;">
                            <li><?php echo $post['fullname'] ?></li>
                            <li><?php echo $post['phonenumber'] ?></li>
                            <li><?php echo $post['email'] ?></li>
                            <li><?php echo $post['adress'] ?></li>
                            
                        </ul>
                        <br><br> <br><br>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12" style="text-align: right;" >
                            <form action="orderList" method="post">
                            @csrf
                            <span><input type="hidden" name="id" value="{{ $s['order_id'] }}">
                                
                                <button type="submit" class="btn btn-primary-dark btn-lg" >Are You Shure?</button>
                                </span>
                            </form>   
                        </div>
                    </div>
                </div>
        </div>
    </div>

@endsection