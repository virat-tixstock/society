{{ Form::open(['url' => 'building', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group">
            {{ Form::label('name', __('name'), ['class' => 'form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter name'), 'required' => 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('floor', __('No. of Floor'), ['class' => 'form-label']) }}
            {{ Form::number('floor', null, ['class' => 'form-control', 'placeholder' => __('Enter floor'), 'required' => 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('unit', __('No. of Unit Per Floor'), ['class' => 'form-label']) }}
            {{ Form::number('unit', null, ['class' => 'form-control', 'placeholder' => __('Enter unit'), 'required' => 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('area', __('area (sqft)'), ['class' => 'form-label']) }}
            {{ Form::text('area', null, ['class' => 'form-control', 'placeholder' => __('Enter area'), 'required' => 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('type', __('type (BHK)'), ['class' => 'form-label']) }}
            {{ Form::text('type', null, ['class' => 'form-control', 'placeholder' => __('Enter type'), 'required' => 'required']) }}
        </div>

    </div>
</div>
<div class="modal-footer">
    {{ Form::submit(__('Create'), ['class' => 'btn btn-secondary ml-10']) }}
</div>
{{ Form::close() }}
