{{ Form::open(['url' => 'unit', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        {{-- <div class="form-group">
            {{ Form::label('building_id', __('building'), ['class' => 'form-label']) }}
            {!! Form::select('building_id', $building, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
        </div> --}}
        {{-- <div class="form-group">
            {{ Form::label('floor_id', __('floor'), ['class' => 'form-label']) }}
            {!! Form::select('floor_id', [], null, ['class' => 'form-control select2', 'required' => 'required']) !!}
        </div> --}}
        <div class="form-group">
            {{ Form::label('unit_number', __('unit number'), ['class' => 'form-label']) }}
            {{ Form::text('unit_number', null, ['class' => 'form-control', 'placeholder' => __('Enter unit number'), 'required' => 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('area', __('area'), ['class' => 'form-label']) }}
            {{ Form::text('area', null, ['class' => 'form-control', 'placeholder' => __('Enter area'), 'required' => 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('type', __('type'), ['class' => 'form-label']) }}
            {{ Form::text('type', null, ['class' => 'form-control', 'placeholder' => __('Enter type'), 'required' => 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('status', __('status'), ['class' => 'form-label']) }}
            {!! Form::select('status', $status, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
        </div>
    </div>
</div>
<div class="modal-footer">
    {{ Form::submit(__('Create'), ['class' => 'btn btn-secondary ml-10']) }}
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
                    $('#floor_id').html(data);
                },
            });
        });
    });
</script>
