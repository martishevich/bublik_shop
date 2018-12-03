@extends('layouts.app')
@section('content')
    <div class = "container">
        <div class = "row justify-content-center">
            <div class = "col-md-12">
                <div>
                    <div class = "card-header">
                        <h1>Order <?= isset($byIdOrd['0']->id) ? $byIdOrd['0']->id : 'unkonown' ?></h1>
                        <a class = "btn btn-primary" href = "/home" role = "button">cabinet</a>
                        <a class = "btn btn-info" href = "/home/orders" role = "button">view</a>
                    </div>

                    @if (session('status'))
                        <div class = "alert alert-success" role = "alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <?php if(isset($byIdOrd['0']->id)) : ?>
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>id</th>
                            <th>fullname</th>
                            <th>telephone</th>
                            <th>email</th>
                            <th>address</th>
                            <th>total</th>
                            <th>payment</th>
                            <th>delivering</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($byIdOrd as $k => $v):?>
                        <tr>
                            <th scope="row"><?php echo $v->id ?></th>
                            <td><?php echo $v->fullname ?></td>
                            <td><?php echo $v->telephone ?></td>
                            <td><?php echo $v->email ?></td>
                            <td><?php echo $v->address ?></td>
                            <td><?php echo number_format($v->total, 2, ',', ' ') ?></td>
                            <td><?php echo $v->payment ?></td>
                            <td><?php echo $v->delivering ?></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <hr>
                    <p>
                        Изменить статус заказа:
                        <a class = "btn btn-primary" href = "/home" role = "button">cabinet</a>
                        <a class = "btn btn-info" href = "/home/orders" role = "button">view</a>
                    </p>
                    <div class = "card-header">
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
                                <th>edit</th>
                                <th>delete</th>
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
                                <td><a class="btn btn-warning" href="/home/orders/<?php $byIdOrd['0']->id?>/edit/<?php echo $v->id ?>" role="button">edit</a></td>
                                <td><a class="btn btn-danger" onclick="return confirm('Are you sure？')" href="/home/orders/<?php $byIdOrd['0']->id?>/delete/<?php echo $v->id ?>" role="button">delete</a></td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <a class="btn btn-success" href="/home/orders/<?php $byIdOrd['0']->id?>/create" role="button">add product</a>
                    <hr>
                    <div class = "card-header">
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
                    <?php else : ?>
                    <p>unknown id</p>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
@endsection