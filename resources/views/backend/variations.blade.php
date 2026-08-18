@extends('layouts.backend')

@section('title', __('Variations'))

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
								{{ __('Variations') }}
							</div>
							<div class="col-lg-6">
								<div class="float-right">
									<a href="{{ route('backend.products') }}" class="btn warning-btn"><i class="fa fa-reply"></i> {{ __('Back to List') }}</a>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body tabs-area p-0">
						@include('backend.partials.product_tabs_nav')
						<div class="tabs-body">
							<!--Data Entry Form-->
							<form novalidate="" data-validate="parsley" id="DataEntry_formId">
								<div class="row">	
									<div class="col-md-12">
										<div class="form-group">
											<label for="variation_size">{{ __('Size') }}</label>
											<select data-placeholder="{{ __('Select Size') }}" name="variation_size[]" id="variation_size" class="chosen-select form-control" multiple>
											@foreach($sizelist as $row)
												<option value="{{ $row->name }}">
													{{ $row->name }}
												</option>
											@endforeach
											</select>
										</div>
									</div>
								</div>
								
								<div class="row">	
									<div class="col-md-12">
										<div class="form-group">
											<label for="variation_color">{{ __('Color') }}</label>
											<select data-placeholder="{{ __('Select color') }}" name="variation_color[]" id="variation_color" class="chosen-select form-control" multiple>
											@foreach($colorlist as $key=>$row)
												<option value="{{ $row->name }}|{{ $row->color }}">
													{{ $row->name }}
												</option>
											@endforeach
											</select>
										</div>
									</div>
								</div>
								
								<div class="row mt-20">
									<div class="col-md-12">
										<div class="card p-3 border">
											<div class="d-flex justify-content-between align-items-center mb-3">
												<div>
													<h5 class="m-0 font-weight-bold text-dark">{{ __('Price & Variant Matrix (ভ্যারিয়েশন ও মূল্য তালিকা)') }}</h5>
													<small class="text-muted">{{ __('এখানে প্রতিটি সাইজ ও কোয়ালিটি/GSM এর জন্য আলাদা দাম নির্ধারণ করুন (যেমন: ১ গ্যালন ৩০০ GSM = ৮০৳)') }}</small>
												</div>
												<div>
													<button type="button" id="btn-add-variant-row" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> {{ __('+ Add Variant Row') }}</button>
												</div>
											</div>
											<div class="table-responsive">
												<table class="table table-bordered table-striped" id="variant-matrix-table">
													<thead class="thead-light">
														<tr>
															<th style="min-width: 140px;">{{ __('Size / পরিমাপ') }}</th>
															<th style="min-width: 140px;">{{ __('Quality / GSM / Color') }}</th>
															<th style="min-width: 120px;">{{ __('Price / মূল্য (৳)') }} <span class="text-danger">*</span></th>
															<th style="min-width: 120px;">{{ __('Old Price / পূর্বের মূল্য (৳)') }}</th>
															<th style="min-width: 100px;">{{ __('Stock Qty') }}</th>
															<th style="min-width: 100px;">{{ __('SKU') }}</th>
															<th style="width: 70px;" class="text-center">{{ __('Default') }}</th>
															<th style="width: 60px;" class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody id="variant-rows-container">
														@if(isset($variations) && count($variations) > 0)
															@foreach($variations as $idx => $v)
															<tr class="variant-row">
																<td>
																	<input type="text" name="variant_size[]" class="form-control form-control-sm" value="{{ $v->size }}" placeholder="e.g. 1 Gallon">
																</td>
																<td>
																	<input type="text" name="variant_color[]" class="form-control form-control-sm" value="{{ $v->color }}" placeholder="e.g. 300 GSM">
																</td>
																<td>
																	<input type="number" step="0.01" name="variant_price[]" class="form-control form-control-sm variant-price" value="{{ $v->price }}" placeholder="80" required>
																</td>
																<td>
																	<input type="number" step="0.01" name="variant_old_price[]" class="form-control form-control-sm" value="{{ $v->old_price }}" placeholder="100">
																</td>
																<td>
																	<input type="number" name="variant_stock_qty[]" class="form-control form-control-sm" value="{{ $v->stock_qty }}" placeholder="999">
																</td>
																<td>
																	<input type="text" name="variant_sku[]" class="form-control form-control-sm" value="{{ $v->sku }}" placeholder="SKU-1">
																</td>
																<td class="text-center align-middle">
																	<input type="radio" name="variant_default" value="{{ $idx }}" {{ $v->is_default ? 'checked' : '' }}>
																</td>
																<td class="text-center align-middle">
																	<button type="button" class="btn btn-sm btn-danger btn-remove-row"><i class="fa fa-trash"></i></button>
																</td>
															</tr>
															@endforeach
														@endif
													</tbody>
												</table>
											</div>
											<div class="mt-2 text-right">
												<button type="button" id="btn-add-variant-row-bottom" class="btn btn-sm btn-outline-primary"><i class="fa fa-plus"></i> {{ __('Add Another Variant Row') }}</button>
											</div>
										</div>
									</div>
								</div>
								
								<input value="{{ $datalist['id'] }}" type="text" name="RecordId" id="RecordId" class="dnone">
								<div class="row tabs-footer mt-15">
									<div class="col-lg-12">
										<a id="submit-form" href="javascript:void(0);" class="btn blue-btn">{{ __('Save Variations') }}</a>
									</div>
								</div>
							</form>
							<!--/Data Entry Form/-->
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>
<!-- /main Section -->
@endsection

@push('scripts')
<!-- css/js -->
<script type="text/javascript">

var sizes = "{{ $datalist['variation_size'] }}";
if(sizes !=''){
	var sizesArr = sizes.split(",");
	$("#variation_size").val(sizesArr).trigger("chosen:updated");
}

var colors = "{{ $datalist['variation_color'] }}";
if(colors !=''){
	var colorsArr = colors.split(",");
	$("#variation_color").val(colorsArr).trigger("chosen:updated");
}

</script>
<script src="{{asset('public/backend/pages/variations.js')}}"></script>
@endpush