<!doctype html>
<head>
    <!-- Place favicon.ico in the root directory -->
    <link rel = "shortcut icon"
          type = "image/x-icon"
          href = "images/favicon.ico">
    <link rel = "apple-touch-icon"
          href = "apple-touch-icon.png">
    <link rel = "stylesheet"
          href = "/bootstrap-4.1.3/bootstrap.min.css"
          integrity = "sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin = "anonymous">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
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
</head>
<body>
<div class = "container">
    <div class = "row">
        <div class = "col-md-4 col-lg-4 col-sm-3 col-xs-4">
            <div class = "logo">
                <img src = "images/logo/logo.png"
                     width = "100%"
                     height = "100%"
                     alt = "logo">
            </div>
        </div>
        <div class = "col-md-2 col-lg-4 col-sm-3 col-xs-2">
        </div>
        <div class = "col-md-4 col-lg-4 col-sm-6 col-xs-4">
            <div class = "info">
                <table class = "table table-sm">
                    <tr>
                        <td>ООО "Bublik corparation" UNP 191191191</td>
                    </tr>
                    <tr>
                        <td>220220, Belarus, Minsk, Kulman st.,11,o. 666</td>
                    </tr>
                    <tr>
                        <td><a href = "tel:+375297000000">+375(29)700-00-00</a>, <a href = "mailto:info@bublik.com">info@bublik.com</a>
                        </td>
                    </tr>
                    <tr>
                        <td>OOO "BelarusBank", <b>SWIFT:</b> SOMABY22<b>,<br> IBAN:</b> BYХХ SOMA 3ХХ4 МB00 0002 0200
                            0007
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<br>
<br><br><br>
<h2>ORDER № <?= $order['id'] ?></h2>
<br><br>
<div class = "container">
    <p>Order Info: </p>
    <div class = "row">
        <div class = "col-md-6 col-sm-6 col-xs-6">
            <table class = "table table-sm">
                <tr>
                    <th>Order date</th>
                    <td><?= date("d M Y", strtotime($order['created_at']))  ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?= $order->getStatusName()->title ?></td>
                </tr>
                <tr>
                    <th>Payment</th>
                    <td><?=$order->getPaymentName()->title?></td>
                </tr>
            </table>
        </div>
        <div class = "col-md-6 col-sm-6 col-xs-6">
            <table class = "table table-sm">
                <tr>
                    <th>Name</th>
                    <td><?= $order['fullname'] ?></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><?= $order['telephone'] ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= $order['email'] ?></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><?= $order['address'] ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<!-- cart-main-area start -->
<div class = "cart-main-area ptb--120 bg__white">
    <div class = "container">
        <div class = "row">
            <div class = "col-md-12 col-sm-12 col-xs-12">
                <div class = "table-content table-responsive">
                    <table class = "table">
                        <thead class = "thead-dark">
                        <tr>
                            <th class = "product-name">Product</th>
                            <th class = "product-price">Price</th>
                            <th class = "product-quantity">Quantity</th>
                            <th class = "product-quantity">VAT</th>
                            <th class = "product-subtotal">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $total = 0; $quantityId = 0; $vatTotal = 0 ?>
                        <?php foreach ($data as $v): ?>
                        <tr>
                            <td class = "product-name"><?= $v['name'] ?></td>
                            <td class = "product-price"><span class = "amount"><?= $v['price'] ?></span></td>
                            <td class = "product-quantity"> <?= $v['quantity'] ?></td>
                            <td class = "product-vat"> <?= $vat = $v['price'] * $v['quantity'] * 0.2 ?></td>
                            <td class = "product-subtotal"><?= $v['price'] * $v['quantity'] ?></td>
                            <?php $vatTotal += $vat ?>
                            <?php $total += $v['price'] * $v['quantity'] ?>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan = "3"
                                class = "product-name">Order Total
                            </td>
                            <td class = "product-subtotal"><?= $vatTotal ?></td>
                            <td class = "product-subtotal"><?= $total ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>