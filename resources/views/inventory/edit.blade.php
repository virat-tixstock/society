{{ Form::model($inventory, ['route' => ['inventory.update', $inventory->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group  col-md-12">
            {{ Form::label('name', __('name'), ['class' => 'form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter name')]) }}
        </div>
        <div class="form-group  col-md-12">
            {{ Form::label('qty', __('quantity'), ['class' => 'form-label']) }}
            {{ Form::number('qty', null, ['class' => 'form-control', 'placeholder' => __('Enter quantity')]) }}
        </div>
        <div class="form-group  col-md-12">
            {{ Form::label('amount', __('amount'), ['class' => 'form-label']) }}
            {{ Form::number('amount', null, ['class' => 'form-control', 'placeholder' => __('Enter amount')]) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    {{ Form::submit(__('Save'), ['class' => 'btn btn-secondary btn-rounded']) }}
</div>
{{ Form::close() }}
