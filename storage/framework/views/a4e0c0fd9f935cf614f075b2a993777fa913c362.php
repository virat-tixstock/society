<?php echo e(Form::open(['url' => 'event', 'method' => 'post', 'enctype' => 'multipart/form-data'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group">
            <?php echo e(Form::label('name', __('name'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter name')])); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('start_datetime', __('start date time'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::date('start_datetime', null, ['class' => 'form-control', 'placeholder' => __('Enter date')])); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('end_datetime', __('end date time'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::date('end_datetime', null, ['class' => 'form-control', 'placeholder' => __('Enter date')])); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('document', __('document'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::file('document', ['class' => 'form-control'])); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('note', __('note'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::textarea('note', null, ['class' => 'form-control','rows'=>2, 'placeholder' => __('Enter note')])); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <?php echo e(Form::submit(__('Create'), ['class' => 'btn btn-secondary btn-rounded'])); ?>

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\wamp64\www\society\resources\views/event/create.blade.php ENDPATH**/ ?>