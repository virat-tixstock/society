{{ Form::model($complaint, ['route' => ['complaint.update', $complaint->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}

<div class="modal-body">
    <div class="row">
        <div class="form-group ">
            <div class="col-md-12">
                {{ Form::label('nature', __('Nature'), ['class' => 'form-label']) }}
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="nature" value="Complaint" id="Complaint" checked>
                <label class="form-check-label" for="Complaint">{{ __('Complaint') }}</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="nature" value="Suggestion" id="Suggestion">
                <label class="form-check-label" for="Suggestion">{{ __('Suggestion') }}</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="nature" value="Request" id="Request">
                <label class="form-check-label" for="Request">{{ __('Request') }}</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="nature" value="Maintenance Request"
                    id="Maintenance_Request">
                <label class="form-check-label" for="Maintenance_Request">{{ __('Maintenance Request') }}</label>
            </div>
        </div>
        <div class="form-group ">
            <div class="col-md-12">
                {{ Form::label('Type', __('Type'), ['class' => 'form-label']) }}
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="type" value="Individual" id="Individual"
                    checked>
                <label class="form-check-label" for="Individual">{{ __('Individual') }}</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="type" value="Compound" id="Compound">
                <label class="form-check-label" for="Compound">{{ __('Compound') }}</label>
            </div>
        </div>
        <div class="form-group  col-md-6">
            {{ Form::label('title', __('Title'), ['class' => 'form-label']) }}
            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Enter title')]) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('member_id', __('member'), ['class' => 'form-label']) }}
            {{ Form::select('member_id', $member, null, ['class' => 'form-control select2']) }}
        </div>
         <div class="form-group col-md-6">
            {{ Form::label('category', __('category'), ['class' => 'form-label']) }}
            {{ Form::select('category', $category, null, ['class' => 'form-control select2']) }}
        </div>
        <div class="form-group  col-md-6">
            {{ Form::label('date', __('date'), ['class' => 'form-label']) }}
            {{ Form::date('date', null, ['class' => 'form-control', 'placeholder' => __('Enter date')]) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('document', __('document'), ['class' => 'form-label']) }}
            {{ Form::file('document', ['class' => 'form-control']) }}
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('status', __('Status'), ['class' => 'form-label']) }}
            {{ Form::select('status', $status, null, ['class' => 'form-control select2']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('note', __('note'), ['class' => 'form-label']) }}
            {{ Form::textarea('note', null, ['class' => 'form-control', 'rows' => 2, 'placeholder' => __('Enter note')]) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    {{ Form::submit(__('Create'), ['class' => 'btn btn-secondary btn-rounded']) }}
</div>
{{ Form::close() }}
