<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Maintenance')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('maintenance.index')); ?>"><?php echo e(__('Maintenance')); ?></a></li>
    <li class="breadcrumb-item" aria-current="page"> <?php echo e(__('Create')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row mt-4">
        <?php echo e(Form::open(['url' => 'maintenance', 'method' => 'post', 'id' => 'book_form'])); ?>

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="info-group">
                        <div class="row">
                            
                            <div class="form-group col-lg-3 col-md-3">
                                <?php echo e(Form::label('member_id', __('member'), ['class' => 'form-label'])); ?>

                                <?php echo Form::select('member_id', $member, null, ['class' => 'form-control select2', 'required' => 'required']); ?>

                            </div>
                            <div class="form-group col-lg-3 col-md-3">
                                <?php echo e(Form::label('month', __('month'), ['class' => 'form-label'])); ?>

                                <?php echo Form::select('month', monthList(), null, ['class' => 'form-control select2', 'required' => 'required']); ?>

                            </div>
                            <div class="form-group col-lg-3 col-md-3">
                                <?php echo e(Form::label('status', __('Status'), ['class' => 'form-label'])); ?>

                                <?php echo Form::select('status', ['Unpaid' => 'Unpaid', 'Paid' => 'Paid'], null, [
                                    'class' => 'form-control select2',
                                    'required' => 'required',
                                ]); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card location">
                <div class="card-header">
                    <h4><?php echo e('Maintenance'); ?></h4>
                </div>
                <div class="card-body">
                    <div class="row location_list">

                        <div class="form-group col-lg-4 col-md-4">
                            <?php echo e(Form::label('', __('type'), ['class' => 'form-label'])); ?>

                            <?php echo Form::select('type[]', $type, null, [
                                'class' => 'form-control select2 type',
                            ]); ?>

                        </div>
                        <div class="form-group col-lg-3 col-md-3">
                            <?php echo e(Form::label('', __('amount'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::number('amount[]', null, ['class' => 'form-control amount', 'placeholder' => __('Enter amount')])); ?>

                        </div>
                        <div class="form-group col-lg-4 col-md-4">
                            <?php echo e(Form::label('', __('note'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::textarea('note[]', null, ['class' => 'form-control note', 'rows' => 1, 'placeholder' => __('Enter note')])); ?>

                        </div>

                        <div class="col-1 m-auto">
                            <a href="javascript:void(0)" class="fs-20 text-danger location_list_remove btn-sm "> <i
                                    data-feather="trash-2"></i></a>
                        </div>
                    </div>
                    <div class="location_list_results"></div>
                    <div class="row ">
                        <div class="col-sm-12">
                            <a href="javascript:void(0)" class="btn btn-secondary btn-xs location_clone "><i
                                    class="ti ti-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="group-button text-end">
                <?php echo e(Form::submit(__('Create'), ['class' => 'btn btn-secondary btn-rounded', 'id' => 'invoice-submit'])); ?>

            </div>
        </div>
        <?php echo e(Form::close()); ?>


    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $('.location').on('click', '.location_list_remove', function() {
            if ($('.location_list').length > 1) {
                $(this).parent().parent().remove();
            }
        });
        $('.location').on('click', '.location_clone', function() {
            let originalRow = $('.location_list:first');
            if ($('select.select2-hidden-accessible').length > 0) {
                originalRow.find('select.select2-hidden-accessible').select2('destroy');
            }
            var clonedlocation = $('.location_clone').closest('.location').find('.location_list').first().clone();
            clonedlocation.find('input[type="text"]').val('');
            clonedlocation.find('input[type="number"]').val('');
            $('.location_list_results').append(clonedlocation);
            if ($('.select2').length > 0) {
                select2();
            }
        });

        $('.location').on('click', '.location_list_remove', function() {
            var id = $(this).data('val');
        });
        $(document).ready(function() {
            $(document).on('change', '#building_id', function() {
                var building_id = $(this).val();
                $.ajax({
                    url: "<?php echo e(route('get.member')); ?>",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        building_id: building_id,
                    },
                    type: 'POST',
                    success: function(data) {
                        $('#member_id').html('');
                        $('#member_id').html(data);
                    },
                });
            });
            $(document).on('change', '.type', function() {
                let row = $(this).closest('.row');
                var type = row.find('.type').val();

                $.ajax({
                    url: "<?php echo e(route('get.type.cost')); ?>",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        type: type,
                    },
                    type: 'POST',
                    success: function(data) {
                        row.find('.amount').val('');
                        row.find('.amount').val(data);
                    },
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\society\resources\views/maintenance/create.blade.php ENDPATH**/ ?>