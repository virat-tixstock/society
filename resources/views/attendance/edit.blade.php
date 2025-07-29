{{ Form::model($attendance, ['route' => ['attendance.update', $attendance->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group ">
            {{ Form::label('user_id', __('user'), ['class' => 'form-label']) }}
            {!! Form::select('user_id', $user, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {{ Form::label('start_datetime', __('start date time'), ['class' => 'form-label']) }}
            {{ Form::datetimeLocal('start_datetime', null, ['class' => 'form-control', 'placeholder' => __('Enter date'),'required' => 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('end_datetime', __('end date time'), ['class' => 'form-label']) }}
            {{ Form::datetimeLocal('end_datetime', null, ['class' => 'form-control', 'placeholder' => __('Enter date')]) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    {{ Form::submit(__('Save'), ['class' => 'btn btn-secondary btn-rounded']) }}
</div>
{{ Form::close() }}
