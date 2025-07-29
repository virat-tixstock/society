<?php echo e(Form::open(['url' => 'floor', 'method' => 'post', 'enctype' => 'multipart/form-data'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group">
            <?php echo e(Form::label('name', __('name'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter name'), 'required' => 'required'])); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('building_id', __('building'), ['class' => 'form-label'])); ?>

            <?php echo Form::select('building_id', $building, null, ['class' => 'form-control select2', 'required' => 'required']); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <?php echo e(Form::submit(__('Create'), ['class' => 'btn btn-secondary ml-10'])); ?>

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\wamp64\www\society\resources\views/floor/create.blade.php ENDPATH**/ ?>