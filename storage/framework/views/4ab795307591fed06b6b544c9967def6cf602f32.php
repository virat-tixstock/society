<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Expense')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('expense.index')); ?>"><?php echo e(__('Expense')); ?></a></li>
    <li class="breadcrumb-item" aria-current="page"> <?php echo e(__('Create')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row mt-4">
        <?php echo e(Form::open(['url' => 'expense', 'method' => 'post', 'id' => 'expense_form'])); ?>

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="info-group">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <div class="">
                                    <?php echo e(Form::label('expense_type', __('Expense Type'), ['class' => 'form-label'])); ?>

                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="expense_type" value="Utility"
                                        id="utility">
                                    <label class="form-check-label" for="utility"><?php echo e(__('Utility bill')); ?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="expense_type" value="Common"
                                        id="common">
                                    <label class="form-check-label" for="common"><?php echo e(__('Common bill')); ?></label>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-6 col-lg-4">
                                <?php echo e(Form::label('date', __('Date'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::date('date', null, ['class' => 'form-control'])); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card location">
                <div class="card-header">
                    <h4><?php echo e('Expense Bill'); ?></h4>
                </div>
                <div class="card-body">
                    <div class="row location_list">

                        <div class="form-group col-md-4 col-lg-4">
                            <?php echo e(Form::label('bill_type', __('Bill Type'), ['class' => 'form-label'])); ?>

                            <?php echo Form::select('bill_type[]', $bill_types, null, [
                                'class' => 'form-control select2',
                                // 'required' => 'required',
                            ]); ?>

                        </div>
                        <div class="form-group col-md-3 col-lg-3">
                            <?php echo e(Form::label('amount', __('amount'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::text('amount[]', null, ['class' => 'form-control', 'placeholder' => __('Enter amount')])); ?>

                        </div>
                        <div class="form-group col-md-4 col-lg-4">
                            <?php echo e(Form::label('note', __('note'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::textarea('note[]', null, ['class' => 'form-control', 'rows' => '1', 'placeholder' => __('Enter note')])); ?>

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
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\society\resources\views/expense/create.blade.php ENDPATH**/ ?>