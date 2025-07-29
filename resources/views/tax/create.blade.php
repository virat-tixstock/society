{{ Form::open(['url' => 'tax', 'method' => 'post']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('title', __('Title'), ['class' => 'form-label']) }}
            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Enter title'), 'required' => 'required']) }}
        </div>

        <div class="form-group col-md-12">
            {{ Form::label('rate', __('Rate'), ['class' => 'form-label']) }}
            {{ Form::number('rate', null, ['class' => 'form-control', 'placeholder' => __('Enter rate'), 'required' => 'required','step' => '0.01']) }}
        </div>
     </div>
</div>
<div class="modal-footer">
    {{ Form::submit(__('Create'), ['class' => 'btn btn-secondary']) }}
</div>
{{ Form::close() }}
