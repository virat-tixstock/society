<?php echo e(Form::open(['url' => 'parking', 'method' => 'post'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group ">
            <div class="col-md-12">
                <?php echo e(Form::label('vehicle_type', __('Vehicle type'), ['class' => 'form-label'])); ?>

            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="vehicle_type" value="Two Wheeler" id="two" checked>
                <label class="form-check-label" for="two"><?php echo e(__('Two Wheeler')); ?></label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="vehicle_type" value="Four Wheeler" id="four">
                <label class="form-check-label" for="four"><?php echo e(__('Four Wheeler')); ?></label>
            </div>
        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('parking_slot', __('parking slot'), ['class' => 'form-label'])); ?>

            <?php echo Form::select('parking_slot', $slots, null, [
                'class' => 'form-control select2',
                'required' => 'required',
            ]); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('building_id', __('building'), ['class' => 'form-label'])); ?>

            <?php echo Form::select('building_id', $building, null, [
                'class' => 'form-control select2',
                'required' => 'required',
            ]); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('unit_id', __('unit'), ['class' => 'form-label'])); ?>

            <?php echo Form::select('unit_id', [], null, [
                'class' => 'form-control select2',
                'required' => 'required',
            ]); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('vehicle_number', __('vehicle number'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('vehicle_number', null, ['class' => 'form-control', 'placeholder' => __('Enter vehicle number'), 'required' => 'required'])); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('vehicle_model', __('vehicle model'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('vehicle_model', null, ['class' => 'form-control', 'placeholder' => __('Enter vehicle model'), 'required' => 'required'])); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('description', __('description'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('description', null, ['class' => 'form-control', 'placeholder' => __('Enter description')])); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <?php echo e(Form::submit(__('Create'), ['class' => 'btn btn-secondary'])); ?>

</div>
<?php echo e(Form::close()); ?>

<script>
    $(document).ready(function() {
        $(document).on('change', '#building_id', function() {
            var building_id = $(this).val();
            $.ajax({
                url: "<?php echo e(route('building.unit')); ?>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    building_id: building_id,
                },
                type: 'POST',
                success: function(data) {
                    $('#unit_id').html('');
                    $('#unit_id').html(data);
                },
            });
        });
        $(document).on('change', 'input[type=radio][name=type]', function() {
            var type = $(this).val();
            $.ajax({
                url: "<?php echo e(route('get.slot')); ?>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    type: type,
                },
                type: 'POST',
                success: function(data) {
                    $('#parking_slot').html('');
                    $('#parking_slot').html(data);
                },
            });
        });
    });
</script>
<?php /**PATH C:\wamp64\www\society\resources\views/parking/create.blade.php ENDPATH**/ ?>