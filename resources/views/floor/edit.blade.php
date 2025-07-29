{{ Form::model($floor, ['route' => ['floor.update', $floor->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group">
            {{ Form::label('name', __('name'), ['class' => 'form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter name'), 'required' => 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('building_id', __('building'), ['class' => 'form-label']) }}
            {!! Form::select('building_id', $building, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
        </div>
    </div>
</div>
<div class="modal-footer">
    {{ Form::submit(__('Create'), ['class' => 'btn btn-secondary ml-10']) }}
</div>
{{ Form::close() }}
