{{ Form::open(['route' => ['member-detail.store', $member->id], 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name'), 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('email', __('Email'), ['class' => 'form-label']) }}
            {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter email'), 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('phone_no', __('Phone Number'), ['class' => 'form-label']) }}
            {{ Form::number('phone_no', null, ['class' => 'form-control', 'placeholder' => __('Enter phone number')]) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('image', __('Profile'), ['class' => 'form-label']) }}
            {{ Form::file('image', ['class' => 'form-control']) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('document', __('Document'), ['class' => 'form-label']) }}
            {{ Form::file('document', ['class' => 'form-control']) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    {{ Form::submit(__('Create'), ['class' => 'btn btn-secondary ml-10']) }}
</div>
{{ Form::close() }}
