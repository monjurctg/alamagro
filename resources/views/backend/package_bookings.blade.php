@extends('layouts.backend')

@section('title', __('Booking Requests'))

@section('content')
<!-- main Section -->
<div class="main-body">
	<div class="container-fluid">
		<div class="row mt-25">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-lg-6">
								<span>{{ __('Booking Requests') }}</span>
							</div>
							<div class="col-lg-6">
								<div class="group-button float-right">
									<!-- Potential Export Buttons -->
								</div>
							</div>
						</div>
					</div>
					<!--Data grid-->
					<div class="card-body">
						<div class="row mb-10">
							<div class="col-lg-8">
								<div class="group-button">
									<a href="{{ route('backend.package-bookings') }}" class="btn btn-theme orderstatus {{ request()->input('status') == '' ? 'active' : '' }}">{{ __('All') }} ({{ $AllCount }})</a>
									<a href="{{ route('backend.package-bookings', ['status' => 'pending']) }}" class="btn btn-theme orderstatus {{ request()->input('status') == 'pending' ? 'active' : '' }}">{{ __('Pending') }} ({{ $PendingCount }})</a>
									<a href="{{ route('backend.package-bookings', ['status' => 'confirmed']) }}" class="btn btn-theme orderstatus {{ request()->input('status') == 'confirmed' ? 'active' : '' }}">{{ __('Confirmed') }} ({{ $ConfirmedCount }})</a>
									<a href="{{ route('backend.package-bookings', ['status' => 'completed']) }}" class="btn btn-theme orderstatus {{ request()->input('status') == 'completed' ? 'active' : '' }}">{{ __('Completed') }} ({{ $CompletedCount }})</a>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="filter-form-group pull-right">
									<form action="{{ route('backend.package-bookings') }}" method="GET">
										<div class="input-group">
											<input name="search" type="text" class="form-control" placeholder="{{ __('Search by Name/Phone') }}" value="{{ request()->input('search') }}">
											<button type="submit" class="btn btn-theme">{{ __('Search') }}</button>
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="table-responsive">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>{{ __('Package') }}</th>
										<th>{{ __('Customer') }}</th>
										<th>{{ __('Address & Message') }}</th>
										<th>{{ __('Status') }}</th>
										<th>{{ __('Date') }}</th>
										<th class="text-center">{{ __('Action') }}</th>
									</tr>
								</thead>
								<tbody>
									@if($datalist->count() > 0)
										@foreach($datalist as $row)
										<tr>
											<td><span class="text-success fw-bold">{{ $row->package_name }}</span></td>
											<td>
												<strong>{{ $row->name }}</strong><br>
												<a href="tel:{{ $row->phone }}">{{ $row->phone }}</a>
											</td>
											<td>
												<small><strong>Add:</strong> {{ $row->address }}</small>
												@if($row->message)
												<br><small class="text-muted"><strong>Msg:</strong> {{ $row->message }}</small>
												@endif
											</td>
											<td>
												@if($row->status == 'pending')
													<span class="badge badge-warning">{{ ucfirst($row->status) }}</span>
												@elseif($row->status == 'confirmed')
													<span class="badge badge-success">{{ ucfirst($row->status) }}</span>
												@elseif($row->status == 'completed')
													<span class="badge badge-primary">{{ ucfirst($row->status) }}</span>
												@endif
											</td>
											<td>{{ date('d-m-Y h:i A', strtotime($row->created_at)) }}</td>
											<td class="text-center">
												<div class="btn-group">
													<button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														{{ __('Status') }}
													</button>
													<div class="dropdown-menu">
														<a class="dropdown-item" href="javascript:void(0);" onclick="updateStatus({{ $row->id }}, 'pending')">{{ __('Pending') }}</a>
														<a class="dropdown-item" href="javascript:void(0);" onclick="updateStatus({{ $row->id }}, 'confirmed')">{{ __('Confirmed') }}</a>
														<a class="dropdown-item" href="javascript:void(0);" onclick="updateStatus({{ $row->id }}, 'completed')">{{ __('Completed') }}</a>
													</div>
												</div>
												<button type="button" onclick="deleteBooking({{ $row->id }})" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
											</td>
										</tr>
										@endforeach
									@else
										<tr>
											<td colspan="6" class="text-center">{{ __('No bookings found.') }}</td>
										</tr>
									@endif
								</tbody>
							</table>
						</div>

						<div class="row">
							<div class="col-md-12">
								{{ $datalist->appends(request()->input())->links('pagination::bootstrap-4') }}
							</div>
						</div>

					</div>
					<!--/Data grid/-->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /main Section -->
@endsection

@push('scripts')
<script type="text/javascript">
	// Update Status
	function updateStatus(id, status) {
		$.ajax({
			type: 'POST',
			url: "{{ route('backend.package-bookings.update-status') }}",
			data: {
				id: id,
				status: status,
				_token: '{{ csrf_token() }}'
			},
			success: function(res) {
				if(res.success) {
					location.reload();
				}
			},
			error: function(err) {
				console.log(err);
			}
		});
	}

	// Delete
	function deleteBooking(id) {
		if(confirm("{{ __('Are you sure you want to delete this booking?') }}")) {
			$.ajax({
				type: 'POST',
				url: "{{ route('backend.package-bookings.delete') }}",
				data: {
					id: id,
					_token: '{{ csrf_token() }}'
				},
				success: function(res) {
					if(res.success) {
						location.reload();
					}
				},
				error: function(err) {
					console.log(err);
				}
			});
		}
	}
</script>
@endpush
