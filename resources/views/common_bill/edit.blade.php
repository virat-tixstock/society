{{ Form::model($commonBill, ['route' => ['common-bill.update', $commonBill->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('bill_type', __('bill type'), ['class' => 'form-label']) }}
            {!! Form::select('bill_type', $bill_types, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
        </div>
        <div class="form-group  col-md-12">
            {{ Form::label('amount', __('amount'), ['class' => 'form-label']) }}
            {{ Form::number('amount', null, ['class' => 'form-control', 'placeholder' => __('Enter amount')]) }}
        </div>
        <div class="form-group  col-md-12">
            {{ Form::label('date', __('date'), ['class' => 'form-label']) }}
            {{ Form::date('date', null, ['class' => 'form-control', 'placeholder' => __('Enter date')]) }}
        </div>
        <div class="form-group  col-md-12">
            {{ Form::label('due_date', __('due date'), ['class' => 'form-label']) }}
            {{ Form::date('due_date', null, ['class' => 'form-control', 'placeholder' => __('Enter due date')]) }}
        </div>
        <div class="form-group  col-md-12">
            {{ Form::label('document', __('document'), ['class' => 'form-label']) }}
            {!! Form::file('document', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('status', __('Status'), ['class' => 'form-label']) }}
            {!! Form::select('status', ['Paid' => 'Paid', 'Unpaid' => 'Unpaid'], null, [
                'class' => 'form-control select2',
                'required' => 'required',
            ]) !!}
        </div>
    </div>
</div>
<div class="modal-footer">
    {{ Form::submit(__('Save'), ['class' => 'btn btn-secondary btn-rounded']) }}
</div>
{{ Form::close() }}
