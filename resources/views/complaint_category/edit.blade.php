{{ Form::model($complaintCategory, ['route' => ['complaint-category.update', $complaintCategory->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group  col-md-12">
            {{ Form::label('title', __('Title'), ['class' => 'form-label']) }}
            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Enter title')]) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    {{ Form::submit(__('save'), ['class' => 'btn btn-secondary btn-rounded']) }}
</div>
{{ Form::close() }}
