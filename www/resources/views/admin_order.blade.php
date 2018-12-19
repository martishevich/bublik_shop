@extends('layouts.app')
@section('content')
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
										<div class = "col-md-3 col-lg-3 col-sm-3 col-xs-3 col-3">
											<h3>Statuses: </h3>
											<div>
												<input class = "form-check-input"
												       type = "checkbox"
												       id = "processing"
												       name = "filter[status][]"
												       value = "<?= \App\StatusOrder::STATUS_PROCESSING ?>"
												<?= (session()->getOldInput('filter.status') !== null && in_array(\App\StatusOrder::STATUS_PROCESSING, session()->getOldInput('filter.status'))) ? 'checked' : '' ?>>
												<label for = "processing">processing</label>
											</div>
											<div>
												<input class = "form-check-input"
												       type = "checkbox"
												       id = "boxing"
												       name = "filter[status][]"
												       value = "<?= \App\StatusOrder::STATUS_BOXING ?>"
												<?= (session()->getOldInput('filter.status') !== null && in_array(\App\StatusOrder::STATUS_BOXING, session()->getOldInput('filter.status'))) ? 'checked' : '' ?>>
												<label for = "boxing">boxing</label>
											</div>
											<div>
												<input class = "form-check-input"
												       type = "checkbox"
												       id = "collected"
												       name = "filter[status][]"
												       value = "<?= \App\StatusOrder::STATUS_COLLECTED ?>"
												<?= (session()->getOldInput('filter.status') !== null && in_array(\App\StatusOrder::STATUS_COLLECTED, session()->getOldInput('filter.status'))) ? 'checked' : '' ?>>
												<label for = "collected">collected</label>
											</div>
											<div>
												<input class = "form-check-input"
												       type = "checkbox"
												       id = "waitingForDelivering"
												       name = "filter[status][]"
												       value = "<?= \App\StatusOrder::STATUS_WAIT_FOR_DELIV ?>"
												<?= (session()->getOldInput('filter.status') !== null && in_array(\App\StatusOrder::STATUS_WAIT_FOR_DELIV, session()->getOldInput('filter.status'))) ? 'checked' : '' ?>>
												<label for = "waitingForDelivering">waiting for delivering</label>
											</div>
											<div>
												<input class = "form-check-input"
												       type = "checkbox"
												       id = "delivering"
												       name = "filter[status][]"
												       value = "<?= \App\StatusOrder::STATUS_DELIVERING ?>"
												<?= (session()->getOldInput('filter.status') !== null && in_array(\App\StatusOrder::STATUS_DELIVERING, session()->getOldInput('filter.status'))) ? 'checked' : '' ?>>
												<label for = "delivering">delivering</label>
											</div>
											<div>
												<input class = "form-check-input"
												       type = "checkbox"
												       id = "delivered"
												       name = "filter[status][]"
												       value = "<?= \App\StatusOrder::STATUS_DELIVERED ?>"
												<?= (session()->getOldInput('filter.status') !== null && in_array(\App\StatusOrder::STATUS_DELIVERED, session()->getOldInput('filter.status'))) ? 'checked' : '' ?>>
												<label for = "delivered">delivered</label>
											</div>
											<div>
												<input class = "form-check-input"
												       type = "checkbox"
												       id = "cancel"
												       name = "filter[status][]"
												       value = "<?= \App\StatusOrder::STATUS_CANCEL ?>"
												<?= (session()->getOldInput('filter.status') !== null && in_array(\App\StatusOrder::STATUS_CANCEL, session()->getOldInput('filter.status'))) ? 'checked' : '' ?>>
												<label for = "cancel">cancel</label>
											</div>
										</div>
										<div class = "col-md-3 col-lg-3 col-sm-3 col-xs-3 col-3">
											<h3>Payments: </h3>
											<div>
												<input class = "form-check-input"
												       type = "checkbox"
												       id = "waitingForPay"
												       name = "filter[payment][]"
												       value = "<?= \App\StatusPayment::STATUS_WAITING ?>"
												<?= (session()->getOldInput('filter.payment') !== null && in_array(\App\StatusPayment::STATUS_WAITING, session()->getOldInput('filter.payment'))) ? 'checked' : '' ?>>
												<label for = "waitingForPay">waiting</label>
											</div>
											<div>
												<input class = "form-check-input"
												       type = "checkbox"
												       id = "cash"
												       name = "filter[payment][]"
												       value = "<?= \App\StatusPayment::STATUS_CASH ?>"
												<?= (session()->getOldInput('filter.payment') !== null && in_array(\App\StatusPayment::STATUS_CASH, session()->getOldInput('filter.payment'))) ? 'checked' : '' ?>>
												<label for = "cash">cash</label>
											</div>
											<div>
												<input class = "form-check-input"
												       type = "checkbox"
												       id = "roga"
												       name = "filter[payment][]"
												       value = "<?= \App\StatusPayment::STATUS_ROGA ?>"
												<?= (session()->getOldInput('filter.payment') !== null && in_array(\App\StatusPayment::STATUS_ROGA, session()->getOldInput('filter.payment'))) ? 'checked' : '' ?>>
												<label for = "roga">bank roga</label>
											</div>
											<div>
												<input class = "form-check-input"
												       type = "checkbox"
												       id = "refund"
												       name = "filter[payment][]"
												       value = "<?= \App\StatusPayment::STATUS_REFUND ?>"
												<?= (session()->getOldInput('filter.payment') !== null && in_array(\App\StatusPayment::STATUS_REFUND, session()->getOldInput('filter.payment'))) ? 'checked' : '' ?>>
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
												       value = "{{old('filter.total_min')}}"
												       step = "100">
												<label for = "filter[total_max]">Max</label>
												<input class = "form-control"
												       type = "number"
												       name = "filter[total_max]"
												       value = "{{old('filter.total_max')}}"
												       step = "100">
											</div>
										</div>
										<div class = "col-md-1 col-lg-1 col-sm-1 col-xs-1 col-1">
											<select name = "filter[pagination]"
											        style = "font-size: 12px"
											        class = "custom-select"
											        id = "inputGroupSelect01">
												<option selected
												        value = "5">5
												</option>
												<option value = "30"
												<?= (session()->getOldInput('filter.pagination') !== null && session()->getOldInput('filter.pagination') == 30) ? 'selected' : '' ?>>
													30
												</option>
												<option value = "50"
												<?= (session()->getOldInput('filter.pagination') !== null && session()->getOldInput('filter.pagination') == 50) ? 'selected' : '' ?>>
													50
												</option>
											</select>
										</div>
										<div class = "col-md-8 col-lg-8 col-sm-8 col-xs-8 col-8">
										</div>
										<div class = "col-md-4 col-lg-4 col-sm-4 col-xs-4 col-4">
											<a class = "btn btn-danger"
											   href = "/home/orders"
											   role = "button">reset</a>
											<input class = " btn btn-success"
											       name = "filter[buttons]"
											       value = "filter"
											       type = "submit">
										</div>
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
					<div class = "text-center">
						{{ $orders->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection