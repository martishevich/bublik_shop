@extends('layouts.app')
@section('content')
    <?php
    /**
     * @var $order \App\Order
     */
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div>
                    <div class="card-header">
                        <h1>Order <?= $order->getKey() ?></h1>
                        <a class="btn btn-primary" href="/home" role="button">cabinet</a>
                        <a class="btn btn-info" href="/home/orders" role="button">view</a>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table">
                        <tr>
                            <th>id</th>
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
                        <?php foreach ($order->getData() as $orderData):?>
                        <tr>
                            <th><?=$orderData->getName();?></th>
                            <td><?=$orderData->value?></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <hr>
                    <p>
                    <form method="post" class="hidden" id="form_change_status"
                          action="/home/orders/status/change&id=<?=$order->getKey()?>">
                        <input type="text" name="status" value="">
                    </form>
                    Изменить статус заказа:
                    @if($order->getStatusId() == \App\StatusForOrder::STATUS_PROCESSING)
                        <input type="button" data-status="cancel" class="btn btn-danger status_btn" value="Cancel">
                        <input type="button" data-status="rebuild" class="btn btn-danger status_btn" value="Rebuild">
                        <input type="button" data-status="boxing" class="btn btn-info status_btn"
                               value="In process boxing">
                        @endif
                        {{--@if(isset($byIdOrd['0']->status_id) && $byIdOrd['0']->status_id == 2)
                        <form method="post" action="/home/orders/<?php echo $byIdOrd['0']->id ?>">
                            @csrf
                            <input type="submit" name="status-order-edit" onclick="return confirm('Are you sure？')" class="btn btn-danger" value="abandonment">
                            <input type="submit" name="status-order-edit" onclick="return confirm('Are you sure？')" class="btn btn-warning" value="going">
                        </form>
                            @endif
                        @if(isset($byIdOrd['0']->status_id) && $byIdOrd['0']->status_id == 3)
                        <form method="post" action="/home/orders/<?php echo $byIdOrd['0']->id ?>">
                            @csrf
                            <input type="submit" name="status-order-edit" onclick="return confirm('Are you sure？')" class="btn btn-danger" value="abandonment">
                            <input type="submit" name="status-order-edit" onclick="return confirm('Are you sure？')" class="btn btn-warning" value="reshape">
                            <input type="submit" name="status-order-edit" onclick="return confirm('Are you sure？')" class="btn btn-warning" value="assembled">
                        </form>
                                @endif
                        @if(isset($byIdOrd['0']->status_id) && $byIdOrd['0']->status_id == 4)
                        <form method="post" action="/home/orders/<?php echo $byIdOrd['0']->id ?>">
                            @csrf
                            <input type="submit" name="status-order-edit" onclick="return confirm('Are you sure？')" class="btn btn-danger" value="abandonment">
                            <input type="submit" name="status-order-edit" onclick="return confirm('Are you sure？')" class="btn btn-warning" value="reshape">
                            <input type="submit" name="status-order-edit" onclick="return confirm('Are you sure？')" class="btn btn-warning" value="waiting for deliver">
                        </form>
                                    @endif
                        @if(isset($byIdOrd['0']->status_id) && $byIdOrd['0']->status_id == 5)
                        <form method="post" action="/home/orders/<?php echo $byIdOrd['0']->id ?>">
                            @csrf
                            <input type="submit" name="status-order-edit" onclick="return confirm('Are you sure？')" class="btn btn-danger" value="abandonment">
                            <input type="submit" name="status-order-edit" onclick="return confirm('Are you sure？')" class="btn btn-warning" value="reshape">
                            <input type="submit" name="status-order-edit" onclick="return confirm('Are you sure？')" class="btn btn-warning" value="delivering">
                        </form>
                                        @endif
                        @if(isset($byIdOrd['0']->status_id) && $byIdOrd['0']->status_id == 6)
                        <form method="post" action="/home/orders/<?php echo $byIdOrd['0']->id ?>">
                            @csrf
                            <input type="submit" name="status-order-edit" onclick="return confirm('Are you sure？')" class="btn btn-danger" value="return in store">
                            <input type="submit" name="status-order-edit" onclick="return confirm('Are you sure？')" class="btn btn-warning" value="delivered">
                        </form>
                                            @endif
                        @if(isset($byIdOrd['0']->status_id) && $byIdOrd['0']->status_id == 7)
                        <form method="post" action="/home/orders/<?php echo $byIdOrd['0']->id ?>">
                            @csrf
                            <input type="submit" name="status-order-edit" onclick="return confirm('Are you sure？')" class="btn btn-danger" value="return in store">
                        </form>
                                                @endif
                        @if(isset($byIdOrd['0']->status_id) && $byIdOrd['0']->status_id == 8)
                        <form method="post" action="/home/orders/<?php echo $byIdOrd['0']->id ?>">
                            @csrf
                            <input type="submit" name="status-order-edit" onclick="return confirm('Are you sure？')" class="btn btn-danger" value="abandonment">
                        </form>
                        @endif--}}
                        </p>
                        <div class="card-header">
                            <h1>Order products</h1>
                        </div>
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th>id</th>
                                <th>product</th>
                                <th>quantity</th>
                                <th>price</th>
                                <th>total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($allProds as $k => $v):?>
                            <tr>
                                <th scope="row"><?php echo $v->id ?></th>
                                <td><?php echo $v->name ?></td>
                                <td><?php echo $v->quantity ?></td>
                                <td><?php echo number_format($v->price, 2, ',', ' ') ?></td>
                                <td><?php echo number_format($v->price * $v->quantity, 2, ',', ' ') ?></td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <hr>
                        <div class="card-header">
                            <h1>Order history</h1>
                        </div>
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th>status</th>
                                <th>comment</th>
                                <th>created_at</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($ordHistory as $k => $v):?>
                            <tr>
                                <th scope="row"><?php echo $v->status ?></th>
                                <td><?php echo $v->comment ?></td>
                                <td><?php echo $v->created_at ?></td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
@endsection