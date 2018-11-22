@extends('layouts.app')
@section('content')
    <div class = "container">
        <div class = "row justify-content-center">
            <div class = "col-md-12">
                <div class = "card">
                    <div class = "card-header"><h1>Products list</h1></div>

                    @if (session('status'))
                        <div class = "alert alert-success" role = "alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>id</th>
                            <th>category_id</th>
                            <th>name</th>
                            <th>description</th>
                            <th>short_disc</th>
                            <th>price</th>
                            <th>is_active</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
		                <?php foreach ($allProd as $k => $v):?>
                        <tr>
                            <th scope="row"><?php echo $v['id'] ?></th>
                            <td><?=htmlentities($v['category_id']); ?></td>
                            <td><?php echo $v['name'] ?></td>
                            <td><?php echo $v['description'] ?></td>
                            <td><?php echo $v['short_disc'] ?></td>
                            <td><?php echo $v['price'] ?></td>
                            <td><?php echo $v['is_active'] ?></td>
                            <td><button type="button" class="btn btn-warning">Edit</button></td>
                            <td><button type="button" class="btn btn-danger">Delete</button></td>
                        </tr>
		                <?php endforeach; ?>
                        </tbody>
                        <tfoot align="center">
                        <td colspan="7">Count</td>
                        <td colspan="2"><?php echo count($allProd) ?></td>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection