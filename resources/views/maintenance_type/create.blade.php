{{ Form::open(['url' => 'maintenance-type', 'method' => 'post']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group  col-md-12">
            {{ Form::label('title', __('title'), ['class' => 'form-label']) }}
            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Enter title')]) }}
        </div>
        <div class="form-group  col-md-12">
            {{ Form::label('amount', __('amount'), ['class' => 'form-label']) }}
            {{ Form::number('amount', null, ['class' => 'form-control', 'placeholder' => __('Enter amount')]) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    {{ Form::submit(__('Create'), ['class' => 'btn btn-secondary btn-rounded']) }}
</div>
{{ Form::close() }}
