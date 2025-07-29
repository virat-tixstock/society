{{ Form::open(['url' => 'parking-slot', 'method' => 'post']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('name', __('name'), ['class' => 'form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter name'), 'required' => 'required']) }}
        </div>
        <div class="form-group ">
            <div class="col-md-12">
                {{ Form::label('vehicle_type', __('Vehicle type'), ['class' => 'form-label']) }}
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="type" value="Two Wheeler" id="two">
                <label class="form-check-label" for="two">{{ __('Two Wheeler') }}</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="type" value="Two Wheeler" id="four">
                <label class="form-check-label" for="four">{{ __('Four Wheeler') }}</label>
            </div>
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('status', __('status'), ['class' => 'form-label']) }}
            {!! Form::select('status', ['Unallocated' => 'Unallocated', 'Allocated' => 'Allocated'], null, [
                'class' => 'form-control select2',
                'required' => 'required',
            ]) !!}
        </div>
    </div>
</div>
<div class="modal-footer">
    {{ Form::submit(__('Create'), ['class' => 'btn btn-secondary']) }}
</div>
{{ Form::close() }}
