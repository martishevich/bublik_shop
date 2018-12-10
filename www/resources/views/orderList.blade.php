<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Bublik store</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <!-- All css files are included here. -->
    <!-- Bootstrap frem-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Owl Carousel main css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="/css/style.css"/>
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="css/custom.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        h2 {
            font-family: DejaVu Sans, sans-serif;
            text-align: center
        }

        .table-content table {
            background: #fff none repeat scroll 0 0;
            border-color: #c1c1c1;
            border-radius: 0;
            border-style: solid;
            border-width: 1px 0 0 1px;
            margin: 0 0 50px;
            text-align: center;
            width: 100%;
        }

        .table-content table th {
            border-top: medium none;
            font-weight: bold;
            padding: 20px 10px;
            text-align: center;
            text-transform: uppercase;
            vertical-align: middle;
            white-space: nowrap;
        }

        .table-content table th,
        .table-content table td {
            border-bottom: 1px solid #c1c1c1;
            border-right: 1px solid #c1c1c1;
        }

        .table-content table td {
            border-top: medium none;
            padding: 20px 10px;
            vertical-align: middle;
            font-size: 13px;
        }

        .table-content table td input {
            background: #e5e5e5 none repeat scroll 0 0;
            border: medium none;
            border-radius: 3px;
            color: #6f6f6f;
            font-size: 15px;
            font-weight: normal;
            height: 40px;
            padding: 0 5px 0 10px;
            width: 60px;
        }

    </style>
    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>

</head>
<body>
<div class="col-md-2 col-lg-2 col-sm-3 col-xs-3">
    <div class="logo">
        <img src="images/logo/logo.png" width="100%" height="100%" alt="logo">
    </div>
</div>
<br>
<br><br><br>
<div class="container">
    <h2>Your order was accepted!</h2>
    <br><br>
    <?php echo 'Client name: ' . $order['fullname'] . '<br> Client phone: ' . $order['telephone'] . '<br> Client email address: ' . $order['email'] . '<br> ' . 'Order number № ' . $order['id'].':';?>
</div>
<!-- cart-main-area start -->
<div class="cart-main-area ptb--120 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="table-content table-responsive">
                    <table class="">
                        <thead>
                        <tr>
                            <th class="product-name">Product</th>
                            <th class="product-price">Price</th>
                            <th class="product-quantity">Quantity</th>
                            <th class="product-subtotal">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $total = 0; $quantityId = 0?>
                        <?php foreach ($data as $v): ?>
                        <tr>
                            <td class="product-name"><a href="#"><?php echo $v['name'] ?></a></td>
                            <td class="product-price"><span class="amount"><?php echo $v['price'] ?></span></td>
                            <td class="product-quantity"> <?php echo $v['quantity'] ?></td>
                            <td class="product-subtotal"><?php echo $v['price'] * $v['quantity'] ?></td>
                            <?php $total = $total + $v['price'] * $v['quantity'] ?>
                        </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div align="left">
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
</body>