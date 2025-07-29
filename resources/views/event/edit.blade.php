{{ Form::model($event, ['route' => ['event.update', $event->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group">
            {{ Form::label('name', __('name'), ['class' => 'form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter name')]) }}
        </div>
        <div class="form-group">
            {{ Form::label('start_datetime', __('start date time'), ['class' => 'form-label']) }}
            {{ Form::datetimeLocal('start_datetime', null, ['class' => 'form-control', 'placeholder' => __('Enter date')]) }}
        </div>
        <div class="form-group">
            {{ Form::label('end_datetime', __('end date time'), ['class' => 'form-label']) }}
            {{ Form::datetimeLocal('end_datetime', null, ['class' => 'form-control', 'placeholder' => __('Enter date')]) }}
        </div>
        <div class="form-group">
            {{ Form::label('document', __('document'), ['class' => 'form-label']) }}
            {{ Form::file('document', ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('note', __('note'), ['class' => 'form-label']) }}
            {{ Form::textarea('note', null, ['class' => 'form-control','rows'=>2, 'placeholder' => __('Enter note')]) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    {{ Form::submit(__('Save'), ['class' => 'btn btn-secondary btn-rounded']) }}
</div>
{{ Form::close() }}
