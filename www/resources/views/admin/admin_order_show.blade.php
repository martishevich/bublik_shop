@extends('layouts.app')
@section('content')
    <?php


    ?>
    <script>
        $(document).ready(function () {

            $('.btn.status_btn').click(function () {
                if (confirm('Are you sure?')) {
                    var value = $(this).data('status');
                    $('#form_change_status>input').val(value);
                    $('#form_change_status').submit();
                }
                return false;
            });

        });
    </script>
    <div class = "container">
        <div class = "row justify-content-center">
            <div class = "col-md-12">
                <div>
                    <div class = "card-header">
                        <h1>Order <?= $order->getKey() ?></h1>
                        <a class = "btn btn-primary"
                           href = "/home"
                           role = "button">cabinet</a>
                        <a class = "btn btn-info"
                           href = "/home/orders"
                           role = "button">view</a>
                    </div>
                    @if (session('status'))
                        <div class = "alert alert-success"
                             role = "alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class = "table">
                        <tr>
                            <th>Order id</th>
                            <td><?=$order->getKey()?></td>
                        </tr>
                        <tr>
                            <th>Full Name</th>
                            <td><?=$order->fullname?></td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td><?=$order->telephone?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?=$order->email?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td><?=$order->address?></td>
                        </tr>
                        <?php foreach ($order->getData() as $orderData):?>
                        <tr>
                            <th><?=$orderData->getName()?></th>
                            <td><?=$orderData->value?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <th>Status</th>
                            <td><?=$order->getStatusName()->title?></td>
                        </tr>
                        <tr>
                            <th>Payment</th>
                            <td><?=$order->getPaymentName()->title?></td>
                        </tr>
                    </table>
                    <hr>
                    <form method = "get"
                          class = "hidden"
                          id = "form_change_status"
                          action = "/home/orders/<?=$order->getKey()?>/change">
                        <input type = "text"
                               name = "status"
                               value = "">
                    </form>
                    @if($order->getStatusId() != \App\StatusOrder::STATUS_CANCEL ?? $order->getStatusId() != \App\StatusOrder::STATUS_RET_IN_STORE)
                        <p>Change status: </p>
                    @else
                        <p>Order is over!</p>
                    @endif
                    @if($order->canCancel())
                        <input type = "button"
                               data-status = "cancel"
                               class = "btn btn-danger status_btn"
                               value = "Cancel">
                    @endif
                    @if($order->canBoxing())
                        <input type = "button"
                               data-status = "boxing"
                               class = "btn btn-info status_btn"
                               value = "In process boxing">
                    @endif
                    @if($order->canCollected())
                        <input type = "button"
                               data-status = "collected"
                               class = "btn btn-info status_btn"
                               value = "Collected">
                    @endif
                    @if($order->canWaiting())
                        <input type = "button"
                               data-status = "waiting"
                               class = "btn btn-info status_btn"
                               value = "Waiting for delivering">
                    @endif
                    @if($order->canDelivering())
                        <input type = "button"
                               data-status = "delivering"
                               class = "btn btn-info status_btn"
                               value = "Delivering">
                    @endif
                    @if($order->canDelivered())
                        <input type = "button"
                               data-status = "delivered"
                               class = "btn btn-info status_btn"
                               value = "Delivered">
                    @endif
                    @if($order->canPaid())
                        <input type = "button"
                               data-status = "paid"
                               class = "btn btn-success status_btn"
                               value = "Paid">
                    @endif
                    <br><br>
                    <p>Send mail again: </p>
                    <a class = "btn btn-warning"
                       href = "/home/orders/<?=$order->getKey()?>/sendmail"
                       role = "button">Resend</a>
                    <br><br>
                    <div class = "card-header">
                        <h1>Order products</h1>
                    </div>
                    <table class = "table">
                        <thead class = "thead-dark">
                        <tr>
                            <th>id</th>
                            <th>product</th>
                            <th>quantity</th>
                            <th>price</th>
                            <th>total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($order->orderProd as $k => $v):?>
                        <tr>
                            <th scope = "row"><?php echo $v->id ?></th>
                            <td><?= $v->product->name ?></td>
                            <td><?= $v->quantity ?></td>
                            <td><?= number_format($v->price, 2, ',', ' ') ?></td>
                            <td><?= number_format($v->price * $v->quantity, 2, ',', ' ') ?></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <hr>
                    <div class = "card-header">
                        <h1>Order history</h1>
                    </div>
                    <table class = "table">
                        <thead class = "thead-dark">
                        <tr>
                            <th>status</th>
                            <th>payment</th>
                            <th>comment</th>
                            <th>created_at</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        @foreach($order->orderStatus as $k => $v)
                            <tr>
                                <td><?= $v->statuses->title ?></td>
                                <td><?= $v->payments->title ?></td>
                                <td><?= $v->comment ?></td>
                                <td><?= $v->created_at ?></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection