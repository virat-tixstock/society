{{ Form::model($parking, ['route' => ['parking.update', $parking->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group ">
            <div class="col-md-12">
                {{ Form::label('vehicle_type', __('Vehicle type'), ['class' => 'form-label']) }}
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="vehicle_type" value="Two Wheeler" id="two"
                    @if ($parking->vehicle_type == 'Two Wheeler') checked @endif>
                <label class="form-check-label" for="two">{{ __('Two Wheeler') }}</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="vehicle_type" value="Four Wheeler" id="four"
                    @if ($parking->vehicle_type == 'Four Wheeler') checked @endif>
                <label class="form-check-label" for="four">{{ __('Four Wheeler') }}</label>
            </div>
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('parking_slot', __('parking slot'), ['class' => 'form-label']) }}
            {!! Form::select('parking_slot', $slots, null, [
                'class' => 'form-control select2',
                'required' => 'required',
            ]) !!}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('building_id', __('building'), ['class' => 'form-label']) }}
            {!! Form::select('building_id', $building, null, [
                'class' => 'form-control select2',
                'required' => 'required',
            ]) !!}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('unit_id', __('unit'), ['class' => 'form-label']) }}
            {!! Form::select('unit_id', $unit, null, [
                'class' => 'form-control select2',
                'required' => 'required',
            ]) !!}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('vehicle_number', __('vehicle number'), ['class' => 'form-label']) }}
            {{ Form::text('vehicle_number', null, ['class' => 'form-control', 'placeholder' => __('Enter vehicle number'), 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('vehicle_model', __('vehicle model'), ['class' => 'form-label']) }}
            {{ Form::text('vehicle_model', null, ['class' => 'form-control', 'placeholder' => __('Enter vehicle model'), 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('description', __('description'), ['class' => 'form-label']) }}
            {{ Form::text('description', null, ['class' => 'form-control', 'placeholder' => __('Enter description')]) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    {{ Form::submit(__('Save'), ['class' => 'btn btn-secondary']) }}
</div>
{{ Form::close() }}
<script>
    $(document).ready(function() {
        $(document).on('change', '#building_id', function() {
            var building_id = $(this).val();
            $.ajax({
                url: "{{ route('building.unit') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    building_id: building_id,
                },
                type: 'POST',
                success: function(data) {
                    $('#unit_id').html('');
                    $('#unit_id').html(data);
                },
            });
        });
        $(document).on('change', 'input[type=radio][name=type]', function() {
            var type = $(this).val();
            $.ajax({
                url: "{{ route('get.slot') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    type: type,
                },
                type: 'POST',
                success: function(data) {
                    $('#parking_slot').html('');
                    $('#parking_slot').html(data);
                },
            });
        });
    });
</script>
