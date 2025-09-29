@extends('layouts.backend')

@section('title', __('Packages'))

@section('content')
	<!-- main Section -->
	<div class="main-body">
		<div class="container-fluid">
			@php $vipc = vipc(); @endphp
			@if($vipc['bkey'] == 0)
				@include('backend.partials.vipc')
			@else
				<div class="row mt-25">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header">
								<div class="row">
									<div class="col-lg-6">
										<span>{{ __('Packages') }}</span>
									</div>
									<div class="col-lg-6">
										<div class="float-right">
											<a onClick="onFormPanel()" href="javascript:void(0);"
												class="btn blue-btn btn-form float-right"><i class="fa fa-plus"></i>
												{{ __('Add New') }}</a>
											<a onClick="onListPanel()" href="javascript:void(0);"
												class="btn warning-btn btn-list float-right dnone"><i class="fa fa-reply"></i>
												{{ __('Back to List') }}</a>
										</div>
									</div>
								</div>
							</div>

							<!--Data grid-->
							<div id="list-panel" class="card-body">
								<div class="row mb-10">
									<div class="col-lg-9">
										<div class="group-button">
											<button type="button" onClick="onDataViewByStatus(0)" id="viewstatus_0"
												class="btn btn-theme viewstatus active">{{ __('All') }}
												({{ $AllCount }})</button>
											<button type="button" onClick="onDataViewByStatus(1)" id="viewstatus_1"
												class="btn btn-theme viewstatus">{{ __('Active') }}
												({{ $PublishedCount }})</button>
											<button type="button" onClick="onDataViewByStatus(2)" id="viewstatus_2"
												class="btn btn-theme viewstatus">{{ __('Inactive') }}
												({{ $DraftCount }})</button>
										</div>
										<input type="hidden" id="view_by_status" value="0" />
									</div>
									<div class="col-md-3"></div>
								</div>

								<div class="row">
									<div class="col-lg-4">
										<div class="form-group bulk-box">
											<select id="bulk-action" class="form-control">
												<option value="">{{ __('Select Action') }}</option>
												<option value="publish">{{ __('Activate') }}</option>
												<option value="draft">{{ __('Deactivate') }}</option>
												<option value="delete">{{ __('Delete Permanently') }}</option>
											</select>
											<button type="submit" onClick="onBulkAction()"
												class="btn bulk-btn">{{ __('Apply') }}</button>
										</div>
									</div>
									<div class="col-lg-3"></div>
									<div class="col-lg-5">
										<div class="form-group search-box">
											<input id="search" name="search" type="text" class="form-control"
												placeholder="{{ __('Search') }}...">
											<button type="submit" onClick="onSearch()"
												class="btn search-btn">{{ __('Search') }}</button>
										</div>
									</div>
								</div>

								<div id="tp_datalist">
									@include('backend.partials.packages_table')
								</div>
							</div>
							<!--/Data grid/-->

							<!--Data Entry Form-->
							<div id="form-panel" class="card-body dnone">
								<form novalidate="" data-validate="parsley" id="DataEntry_formId">
									 <input type="hidden" name="RecordId" id="RecordId">



									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="title">{{ __('Package Name') }} <span class="red">*</span></label>
												<input type="text" name="title" id="title" class="form-control" required>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="subtitle">{{ __('Subtitle') }}</label>
												<input type="text" name="subtitle" id="subtitle" class="form-control">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="price">{{ __('Price') }}</label>
												<input type="number" step="0.01" name="price" id="price" class="form-control"
													required>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label for="frequency">{{ __('Frequency') }}</label>
												<input type="text" name="frequency" id="frequency" class="form-control"
													placeholder="Ex: মাসে ২ বার">
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label for="duration">{{ __('Duration') }}</label>
												<input type="text" name="duration" id="duration" class="form-control"
													placeholder="Ex: ১.৫ - ২ ঘন্টা">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="type">{{ __('Type') }}</label>
												<select name="type" id="type" class="form-control">
													<option value="monthly">Monthly</option>
													<option value="fullday">Full Day</option>
													<option value="custom">Custom</option>
												</select>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label>{{ __('Features (comma separated)') }}</label>
												<input type="text" name="features" id="features" class="form-control"
													placeholder="গাছ ছাঁটাই, আগাছা পরিষ্কার, সার-পানি দেওয়া">
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label>{{ __('Popular?') }}</label><br>
												<input type="checkbox" name="is_popular" id="is_popular" value="1">
												{{ __('Mark as popular') }}
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="status">{{ __('Status') }}</label>
												<select name="status" id="status" class="form-control">
													<option value="1">{{ __('Active') }}</option>
													<option value="0">{{ __('Inactive') }}</option>
												</select>
											</div>
										</div>
									</div>

									<div class="row tabs-footer mt-15">
										<div class="col-lg-12">
											<a id="submit-form" href="javascript:void(0);"
												class="btn blue-btn mr-10">{{ __('Save') }}</a>
											<a onClick="onListPanel()" href="javascript:void(0);"
												class="btn danger-btn">{{ __('Cancel') }}</a>
										</div>
									</div>
								</form>
							</div>


							<!--/Data Entry Form/-->
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>
	<!-- /main Section --> 
@endsection

@push('scripts')
	<!-- js text constants -->
	<script type="text/javascript">
		var TEXT = [];
		TEXT['Do you really want to edit this record'] = "{{ __('Do you really want to edit this record') }}";
		TEXT['Do you really want to delete this record'] = "{{ __('Do you really want to delete this record') }}";
		TEXT['Do you really want to publish this records'] = "{{ __('Do you really want to activate these records') }}";
		TEXT['Do you really want to draft this records'] = "{{ __('Do you really want to deactivate these records') }}";
		TEXT['Do you really want to delete this records'] = "{{ __('Do you really want to delete these records') }}";
		TEXT['Please select action'] = "{{ __('Please select action') }}";
		TEXT['Please select record'] = "{{ __('Please select record') }}";
	</script>
	<script src="{{asset('public/backend/pages/packages.js')}}"></script>
	<script src="{{asset('public/backend/pages/global-media.js')}}"></script>
@endpush