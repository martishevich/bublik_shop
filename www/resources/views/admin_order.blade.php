@extends('layouts.app')
@section('content')
    <script>
        $(document).ready(function() {
            $('.btn btn-danger').click(function() {
                if (confirm('Are you sure?')) {
                    var url = $(this).attr('href');
                    $('#content').load(url);
                }
            });
        });
    </script>
    <div class = "container">
        <div class = "row justify-content-center">
            <div class = "col-md-12">
                <div>
                    <div class = "card-header">
                        <h1>Products list</h1>
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
                            <th>adres</th>
                            <th>status</th>
                            <th>details</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($allOrd as $k => $v):?>
                        <tr>
                            <th scope="row"><?php echo $v['id'] ?></th>
                            <td><?=htmlentities($v['fullname']); ?></td>
                            <td><?php echo $v['telephone'] ?></td>
                            <td><?php echo $v['email'] ?></td>
                            <td><?php echo $v['adres'] ?></td>
                            <td><?php echo $v['status'] ?></td>
                            <td><a class="btn btn-info" href="/home/order/<?php echo $v['id'] ?>" role="button">details</a></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection