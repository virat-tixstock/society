<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Details')); ?>

<?php $__env->stopSection(); ?>

<?php
    $admin_logo = getSettingsValByName('company_logo');
    $settings = settings();
?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('click', '.print', function() {
            $('.action').addClass('d-none');
            var printContents = document.getElementById('po-print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            $('.action').removeClass('d-none');
        });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>">
                <?php echo e(__('Dashboard')); ?>

            </a>
        </li>
        <li class="breadcrumb-item active">
            <a href="<?php echo e(route('expense.index')); ?>"><?php echo e(__('Expense')); ?></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#"><?php echo e(__('Details')); ?></a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div id="po-print">
            <div class="col-sm-12">
                <div class="d-print-none card mb-3">
                    <div class="card-body p-3">
                        <ul class="list-inline ms-auto mb-0 d-flex justify-content-end flex-wrap">
                            <li class="list-inline-item align-bottom me-2">
                                <a href="#" class="avtar avtar-s btn-link-secondary print" data-bs-toggle="tooltip"
                                    data-bs-original-title="<?php echo e(__('Download')); ?>">
                                    <i class="ph-duotone ph-printer f-22"></i>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="card">

                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="row align-items-center g-3">
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center mb-2 navbar-brand img-fluid invoice-logo">
                                            <img src="<?php echo e(asset(Storage::url('upload/logo/')) . '/' . (isset($admin_logo) && !empty($admin_logo) ? $admin_logo : 'logo.png')); ?>"
                                                class="img-fluid brand-logo" alt="images" />
                                        </div>

                                        <p class="mb-0"><?php echo e(expensePrefix() . $expense->expense_id); ?></p>
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="h4">
                                    <?php echo e(__('Details')); ?>

                                </div>

                                
                            </div>


                            <div class="col-12">

                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th><?php echo e(__('Bill Type')); ?></th>
                                                <th><?php echo e(__('note')); ?></th>
                                                <th><?php echo e(__('Amount')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $total = 0;
                                            ?>
                                            <?php $__currentLoopData = $expense->ExpenseDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $total += $product->amount;
                                                ?>
                                                <tr>
                                                    <td><?php echo e(!empty($product->ExpenseType) ? $product->ExpenseType->title : '-'); ?>

                                                    </td>
                                                    <td><?php echo e($product->note); ?></td>
                                                    <td><?php echo e(priceFormat($product->amount)); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="invoice-total ms-auto">
                                    <div class="row">

                                        <div class="col-6">
                                            <p class="f-w-600 mb-1 text-start"><?php echo e(__('Total Amount')); ?> :</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="f-w-600 mb-1 text-end">
                                                <?php echo e(priceFormat($total)); ?>

                                            </p>
                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\society\resources\views/expense/show.blade.php ENDPATH**/ ?>