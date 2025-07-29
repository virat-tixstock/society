{{ Form::model($member, ['route' => ['member.update', $member->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name'), 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('email', __('Email'), ['class' => 'form-label']) }}
            {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter email'), 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('phone_no', __('Phone Number'), ['class' => 'form-label']) }}
            {{ Form::text('phone_no', null, ['class' => 'form-control', 'placeholder' => __('Enter phone number')]) }}
        </div>
        {{-- <div class="form-group col-md-6">
            {{ Form::label('building_id', __('Building'), ['class' => 'form-label']) }}
            {!! Form::select('building_id', $building, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
        </div> --}}
        {{-- <div class="form-group col-md-6">
            {{ Form::label('floor_id', __('Floor'), ['class' => 'form-label']) }}
            {!! Form::select('floor_id', $floor, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
        </div> --}}
        <div class="form-group col-md-6">
            {{ Form::label('unit_id', __('unit'), ['class' => 'form-label']) }}
            {!! Form::select('unit_id', $unit, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('image', __('Profile'), ['class' => 'form-label']) }}
            {{ Form::file('image', ['class' => 'form-control']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('document', __('Document'), ['class' => 'form-label']) }}
            {{ Form::file('document', ['class' => 'form-control']) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    {{ Form::submit(__('Save'), ['class' => 'btn btn-secondary ml-10']) }}
</div>
{{ Form::close() }}
<script>
    $(document).ready(function() {
        $(document).on('change', '#building_id', function() {
            var building_id = $(this).val();
            $.ajax({
                url: "{{ route('get.floor') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    building_id: building_id,
                },
                type: 'POST',
                success: function(data) {
                    $('#floor_id').html('');
                    $('#unit_id').html('');
                    $('#floor_id').html(data);
                },
            });
        });
        $(document).on('change', '#floor_id', function() {
            var floor_id = $(this).val();
            var building_id = $('#building_id').val();
            $.ajax({
                url: "{{ route('get.unit') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    building_id: building_id,
                    floor_id: floor_id,
                },
                type: 'POST',
                success: function(data) {
                    $('#unit_id').html('');
                    $('#unit_id').html(data);
                },
            });
        });
    });
</script>
