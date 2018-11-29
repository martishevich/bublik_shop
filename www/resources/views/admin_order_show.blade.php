@extends('layouts.app')
@section('content')
    <div class = "container">
        <div class = "row justify-content-center">
            <div class = "col-md-12">
                <div>
                    <div class = "card-header">
                        <h1>Order <?= $allOrd['0']->id ?></h1>
                    </div>

                    @if (session('status'))
                        <div class = "alert alert-success" role = "alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>id</th>
                            <th>fullname</th>
                            <th>telephone</th>
                            <th>email</th>
                            <th>address</th>
                            <th>total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($allOrd as $k => $v):?>
                        <tr>
                            <th scope="row"><?php echo $v->id ?></th>
                            <td><?php echo $v->fullname ?></td>
                            <td><?php echo $v->telephone ?></td>
                            <td><?php echo $v->email ?></td>
                            <td><?php echo $v->address ?></td>
                            <td><?php echo number_format($v->total, 2, ',', ' ') ?></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection