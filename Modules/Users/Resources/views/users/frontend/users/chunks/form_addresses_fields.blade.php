{!! Form::hidden('address['.$type.'][is_' . $type . ']', 1) !!}

<div class="form-group form-group-default">
    {!! Form::label('country_a2', 'Country', array('class'=>'control-label')) !!}
    {!! Addresses::selectCountry('address['.$type.'][country_a2]', old('address['.$type.'][country_a2]', (!empty($address) ? $address->country_a2 : \Config::get('users.default_country'))), array('class'=>'form-control js-call-select2')) !!}
</div>

<div class="form-group form-group-default">
    {!! Form::label('state_a2', 'State / Province', array('class'=>'control-label')) !!}
    {!! Addresses::selectState('address['.$type.'][state_a2]', old('address['.$type.'][state_a2]', (!empty($address) ? $address->state_a2 : null)), array('class'=>'form-control js-call-select2', 'country'=>\Config::get('users.default_country'))) !!}
</div>

<div class="form-group form-group-default">
    {!! Form::label('zip', 'Zip / Postal Code', array('class'=>'control-label')) !!}
    {!! Form::text('address['.$type.'][zip]', old('address['.$type.'][zip]', (!empty($address) ? $address->zip : null)), array('class'=>'form-control', 'placeholder'=>'Postal Code')) !!}
</div>

<div class="form-group form-group-default">
    {!! Form::label('city', 'City / Town', array('class'=>'control-label')) !!}
    {!! Form::text('address['.$type.'][city]', old('address['.$type.'][city]', (!empty($address) ? $address->city : null)), array('class'=>'form-control', 'placeholder'=>'Town or City Name')) !!}
</div>

<div class="form-group form-group-default">
    {!! Form::label('street', 'Street Address', array('class'=>'control-label')) !!}
    {!! Form::text('address['.$type.'][street]', old('address['.$type.'][street]', (!empty($address) ? $address->street : null)), array('class'=>'form-control', 'placeholder'=>'Street Address')) !!}
    {!! Form::text('address['.$type.'][street_extra]', old('address['.$type.'][street_extra]', (!empty($address) ? $address->street_extra : null)), array('class'=>'form-control', 'placeholder'=>'', 'style'=>'margin-top:6px')) !!}
</div>

<div class="form-group form-group-default">
    {!! Form::label('organization', 'Organization', array('class'=>'control-label')) !!}
    {!! Form::text(
        'address['.$type.'][organization]',
        old('address['.$type.'][organization]', (!empty($address) ? $address->organization : null)),
        array('class'=>'form-control', 'placeholder'=>'Organization')
    ) !!}
</div>
