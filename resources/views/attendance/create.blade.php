{{ Form::open(['url' => 'attendance', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group ">
            {{ Form::label('user_id', __('user'), ['class' => 'form-label']) }}
            {!! Form::select('user_id', $user, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {{ Form::label('in_datetime', __('In date time'), ['class' => 'form-label']) }}
            {{ Form::datetimeLocal('in_datetime', null, ['class' => 'form-control', 'placeholder' => __('Enter date'), 'required' => 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('out_datetime', __('out date time'), ['class' => 'form-label']) }}
            {{ Form::datetimeLocal('out_datetime', null, ['class' => 'form-control', 'placeholder' => __('Enter date')]) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    {{ Form::submit(__('Create'), ['class' => 'btn btn-secondary btn-rounded']) }}
</div>
{{ Form::close() }}
