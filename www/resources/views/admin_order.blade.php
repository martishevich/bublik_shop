@extends('layouts.app')
@section('content')
    <?php dump($_GET) ?>
    <div class = "container">
        <div class = "row justify-content-center">
            <div class = "col-md-12">
                <div>
                    <div class = "card-header">
                        <h1>Orders list</h1>
                    </div>
                    @if (session('status'))
                        <div class = "alert alert-success"
                             role = "alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div style = "padding-top: 20px; padding-bottom: 20px">
                        <form
                                action = "orders"
                                method = "get">
                            <fieldset>
                                <legend>Test your luck!</legend>
                                <div class = "container">
                                    <div class = "row">
                                        <div class = "col-md-4 col-lg-4 col-sm-4 col-xs-4 col-4">
                                            <h3>Statuses: </h3>
                                            <div>
                                                <input class = "form-check-input"
                                                       type = "checkbox"
                                                       id = "processing"
                                                       name = "filter[status][]"
                                                       value = "<?= \App\StatusOrder::STATUS_PROCESSING ?>">
                                                <label for = "processing">processing</label>
                                            </div>
                                            <div>
                                                <input class = "form-check-input"
                                                       type = "checkbox"
                                                       id = "boxing"
                                                       name = "filter[status][]"
                                                       value = "<?= \App\StatusOrder::STATUS_BOXING ?>">
                                                <label for = "boxing">boxing</label>
                                            </div>
                                            <div>
                                                <input class = "form-check-input"
                                                       type = "checkbox"
                                                       id = "collected"
                                                       name = "filter[status][]"
                                                       value = "<?= \App\StatusOrder::STATUS_COLLECTED ?>">
                                                <label for = "boxing">collected</label>
                                            </div>
                                            <div>
                                                <input class = "form-check-input"
                                                       type = "checkbox"
                                                       id = "waiting"
                                                       name = "filter[status][]"
                                                       value = "<?= \App\StatusOrder::STATUS_WAIT_FOR_DELIV ?>">
                                                <label for = "boxing">waiting for delivering</label>
                                            </div>
                                            <div>
                                                <input class = "form-check-input"
                                                       type = "checkbox"
                                                       id = "delivering"
                                                       name = "filter[status][]"
                                                       value = "<?= \App\StatusOrder::STATUS_DELIVERING ?>">
                                                <label for = "boxing">delivering</label>
                                            </div>
                                            <div>
                                                <input class = "form-check-input"
                                                       type = "checkbox"
                                                       id = "delivered"
                                                       name = "filter[status][]"
                                                       value = "<?= \App\StatusOrder::STATUS_DELIVERED ?>">
                                                <label for = "delivered">delivered</label>
                                            </div>
                                            <div>
                                                <input class = "form-check-input"
                                                       type = "checkbox"
                                                       id = "cancel"
                                                       name = "filter[status][]"
                                                       value = "<?= \App\StatusOrder::STATUS_CANCEL ?>">
                                                <label for = "cancel">cancel</label>
                                            </div>
                                        </div>
                                        <div class = "col-md-4 col-lg-4 col-sm-4 col-xs-4 col-4">
                                            <h3>Payments: </h3>
                                            <div>
                                                <input class = "form-check-input"
                                                       type = "checkbox"
                                                       id = "waiting"
                                                       name = "filter[payment][]"
                                                       value = "<?= \App\StatusPayment::STATUS_WAITING ?>">
                                                <label for = "waiting">waiting</label>
                                            </div>
                                            <div>
                                                <input class = "form-check-input"
                                                       type = "checkbox"
                                                       id = "cash"
                                                       name = "filter[payment][]"
                                                       value = "<?= \App\StatusPayment::STATUS_CASH ?>">
                                                <label for = "cash">cash</label>
                                            </div>
                                            <div>
                                                <input class = "form-check-input"
                                                       type = "checkbox"
                                                       id = "roga"
                                                       name = "filter[payment][]"
                                                       value = "<?= \App\StatusPayment::STATUS_ROGA ?>">
                                                <label for = "roga">bank roga</label>
                                            </div>
                                            <div>
                                                <input class = "form-check-input"
                                                       type = "checkbox"
                                                       id = "refund"
                                                       name = "filter[payment][]"
                                                       value = "<?= \App\StatusPayment::STATUS_REFUND ?>">
                                                <label for = "refund">refund</label>
                                            </div>
                                        </div>
                                        <div class = "col-md-3 col-lg-3 col-sm-3 col-xs-3 col-3">
                                            <h3>Total: </h3>
                                            <div>
                                                <label for = "filter[total_min]">Min</label>
                                                <input class = "form-control"
                                                       type = "number"
                                                       name = "filter[total_min]"
                                                       min = "0"
                                                       max = "10000"
                                                       value = "0"
                                                       step = "100">
                                                <label for = "filter[total_max]">Max</label>
                                                <input class = "form-control"
                                                       type = "number"
                                                       name = "filter[total_max]"
                                                       min = "0"
                                                       max = "10000"
                                                       value = "10000"
                                                       step = "100">
                                            </div>
                                        </div>
                                        <input style = "margin-left: 80%;"
                                               class = " btn btn-success"
                                               name = "filter[submit]"
                                               value = "Filter"
                                               type = "submit">
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <table class = "table">
                        <thead class = "thead-dark">
                        <tr>
                            <th>id</th>
                            <th>fullname</th>
                            <th>telephone</th>
                            <th>email</th>
                            <th>address</th>
                            <th>status</th>
                            <th>payment</th>
                            <th>total</th>
                            <th>details</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($orders as $k => $v):?>
                        <tr>
                            <th scope = "row"><?php echo $v->id ?></th>
                            <td><?php echo $v->fullname ?></td>
                            <td><?php echo $v->telephone ?></td>
                            <td><?php echo $v->email ?></td>
                            <td><?php echo $v->address ?></td>
                            <td><?php echo $v->title_stat ?></td>
                            <td><?php echo $v->title_pay ?></td>
                            <td><?php echo number_format($v->total, 2, ',', ' ') ?></td>
                            <td><a class = "btn btn-info"
                                   href = "/home/orders/<?php echo $v->id ?>"
                                   role = "button">details</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection