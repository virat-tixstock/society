<?php echo e(Form::model($unit, ['route' => ['unit.update', $unit->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

<div class="modal-body">
    <div class="row">
        
        
        <div class="form-group">
            <?php echo e(Form::label('unit_number', __('unit number'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('unit_number', null, ['class' => 'form-control', 'placeholder' => __('Enter unit number'), 'required' => 'required'])); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('area', __('area'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('area', null, ['class' => 'form-control', 'placeholder' => __('Enter area'), 'required' => 'required'])); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('type', __('type'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('type', null, ['class' => 'form-control', 'placeholder' => __('Enter type'), 'required' => 'required'])); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('status', __('status'), ['class' => 'form-label'])); ?>

            <?php echo Form::select('status', $status, null, ['class' => 'form-control select2', 'required' => 'required']); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <?php echo e(Form::submit(__('Edit'), ['class' => 'btn btn-secondary ml-10'])); ?>

</div>
<?php echo e(Form::close()); ?>

<script>
    $(document).ready(function() {
        $(document).on('change', '#building_id', function() {
            var building_id = $(this).val();
            $.ajax({
                url: "<?php echo e(route('get.floor')); ?>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    building_id: building_id,
                },
                type: 'POST',
                success: function(data) {
                    $('#floor_id').html('');
                    $('#floor_id').html(data);
                },
            });
        });
    });
</script>
<?php /**PATH C:\wamp64\www\society\resources\views/unit/edit.blade.php ENDPATH**/ ?>