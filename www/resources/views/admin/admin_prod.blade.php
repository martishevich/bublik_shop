@extends('layouts.app')
@section('content')
	<script>
        $(document).ready(function () {
            $('.btn btn-danger').click(function () {
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
						@if (session('is_edit')=='true')
							<p class = "text-success">Данные удачно изменены</p>
						@endif
						@if (session('is_del')=='true')
							<p class = "text-success">Данные удачно удалены</p>
						@endif
						<a class = "btn btn-success"
						   href = "/home/products/create"
						   role = "button">add new</a>
					</div>
					@if (session('status'))
						<div class = "alert alert-success"
						     role = "alert">
							{{ session('status') }}
						</div>
					@endif
					<table class = "table">
						<thead class = "thead-dark">
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
							<th scope = "row"><?php echo $v['id'] ?></th>
							<td><?=htmlentities($v['category_id']); ?></td>
							<td><?php echo htmlentities($v['name']) ?></td>
							<td><?php echo htmlentities($v['description']) ?></td>
							<td><?php echo htmlentities($v['short_disc']) ?></td>
							<td><?php echo htmlentities($v['price']) ?></td>
							<td><?php echo htmlentities($v['is_active']) ?></td>
							<td><a class = "btn btn-warning"
							       href = "/home/products/edit/<?php echo $v['id'] ?>"
							       role = "button">edit</a></td>
							<td><a class = "btn btn-danger"
							       onclick = "return confirm('Are you sure？')"
							       href = "/home/products/delete/<?php echo $v['id'] ?>"
							       role = "button">delete</a></td>
						</tr>
						<?php endforeach; ?>
						</tbody>
						<tfoot align = "center">
						<td colspan = "7">Count</td>
						<td colspan = "2"><?php echo count($allProd) ?></td>
						</tfoot>
					</table>
				</div>
			</div>
			{{ $allProd->links() }}
		</div>
	</div>
@endsection