<?php echo e(Form::open(['url' => 'inventory', 'method' => 'post'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('name', __('name'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter name')])); ?>

        </div>
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('qty', __('quantity'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::number('qty', null, ['class' => 'form-control', 'placeholder' => __('Enter quantity')])); ?>

        </div>
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('amount', __('amount'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::number('amount', null, ['class' => 'form-control', 'placeholder' => __('Enter amount')])); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <?php echo e(Form::submit(__('Create'), ['class' => 'btn btn-secondary btn-rounded'])); ?>

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\wamp64\www\society\resources\views/inventory/create.blade.php ENDPATH**/ ?>