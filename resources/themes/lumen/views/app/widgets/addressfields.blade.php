@push('widget-scripts')
	<script src="{{ asset('themes/lumen/js/app/widgets/addressfields.js') }}"></script>
@endpush

@if (config('addresses.show_country') && $show_country)
	<div class="form-group">
		{!! Form::label($prefix . '_address_country_id', trans('widgets/addressfields.country_address'), ['class'=>'col-sm-3 control-label']) !!}
		<div class="col-sm-9">
			{!! Addresses::selectCountry(
				$prefix . '_address_country_id',
				old($prefix . '_address_country_id', $address['country_id']),
				[
					'class' => 'form-control',
					'data-state_id' => $address['state_id']
				]
			) !!}
		</div>
	</div>
@endif

@if (config('addresses.show_state') && $show_state)
	<div class="form-group">
		{!! Form::label($prefix . '_address_state_id', trans('widgets/addressfields.state_or_province_address'), ['class'=>'col-sm-3 control-label']) !!}
		<div class="col-sm-9">
			<select id="{{ $prefix }}_address_state_id" class="form-control" name="{{ $prefix }}_address_state_id"
					data-value="{{ old($prefix . '_address_state_id', $address['state_id']) }}"
					data-country_id="{{ old($prefix . '_address_country_id', $address['country_id']) }}"
			></select>
		</div>
	</div>
@endif

<div class="form-group">
	{!! Form::label($prefix . '_address_substate_id', trans('widgets/addressfields.substate_address'), ['class'=>'col-sm-3 control-label']) !!}
	<div class="col-sm-9">
		<select id="{{ $prefix }}_address_substate_id" class="form-control" name="{{ $prefix }}_address_substate_id"
				data-value="{{ old($prefix . '_address_substate_id', $address['substate_id']) }}"
				data-state_id="{{ old($prefix . '_address_state_id', $address['state_id']) }}"
				data-country_id="{{ old($prefix . '_address_country_id', $address['country_id']) }}"
		></select>
	</div>
</div>

<div class="form-group">
	{!! Form::label($prefix . '_address_street', trans('widgets/addressfields.street_address'), ['class'=>'col-sm-3 control-label']) !!}
	<div class="col-sm-9">
		{!! Form::text($prefix . '_address_street', old($prefix . '_address_street', $address['street']), ['class'=>'form-control']) !!}
		{!! Form::text($prefix . '_address_street_extra', old($prefix . '_address_street_extra', $address['street_extra']), ['class'=>'form-control', 'style'=>'margin-top:6px;']) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label($prefix . '_address_city', trans('widgets/addressfields.city_or_town_address'), ['class'=>'col-sm-3 control-label']) !!}
	<div class="col-sm-4">
		{!! Form::text($prefix . '_address_city', old($prefix . '_address_city', $address['city']), ['class'=>'form-control']) !!}
	</div>
	{!! Form::label($prefix . '_address_zip', trans('widgets/addressfields.zipcode_or_postal_code_address'), ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-3">
		{!! Form::text($prefix . '_address_zip', old($prefix . '_address_zip', $address['zip']), ['class'=>'form-control']) !!}
	</div>
</div>
