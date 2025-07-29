{{ Form::model($building, ['route' => ['building.update', $building->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}

<div class="modal-body">
    <div class="row">
        <div class="form-group">
            {{ Form::label('name', __('name'), ['class' => 'form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter name'), 'required' => 'required']) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    {{ Form::submit(__('Save'), ['class' => 'btn btn-secondary ml-10']) }}
</div>
{{ Form::close() }}
