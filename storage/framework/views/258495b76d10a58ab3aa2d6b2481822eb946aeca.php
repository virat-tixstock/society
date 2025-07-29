<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Expense')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item" aria-current="page"> <?php echo e(__('Expense')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5><?php echo e(__('Expense List')); ?></h5>
                        </div>
                        <?php if(Gate::check('create expense')): ?>
                            <div class="col-auto">
                                <a class="btn btn-secondary " href="<?php echo e(route('expense.create')); ?>"> <i
                                        class="ti ti-circle-plus align-text-bottom"></i>
                                    <?php echo e(__('Create Expense')); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('ID')); ?></th>
                                    
                                    <th><?php echo e(__('date')); ?></th>
                                    <th><?php echo e(__('Total Amount')); ?></th>
                                    <th class="text-right"><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(expensePrefix() . $expense->expense_id); ?></td>
                                        
                                        <td><?php echo e(dateFormat($expense->date)); ?></td>
                                        <td><?php echo e(!empty($expense->ExpenseDetails) ? priceFormat($expense->ExpenseDetails->sum('amount')) : 0); ?>

                                        </td>
                                        <td>
                                            <div class="cart-action">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['expense.destroy', $expense->id]]); ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show expense')): ?>
                                                    <a class="avtar avtar-xs btn-link-warning text-warning"
                                                        href="<?php echo e(route('expense.show', $expense->id)); ?>"> <i
                                                            data-feather="eye"></i></a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit expense')): ?>
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary"
                                                        href="<?php echo e(route('expense.edit', $expense->id)); ?>"> <i
                                                            data-feather="edit"></i></a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete expense')): ?>
                                                    <a class=" avtar avtar-xs btn-link-danger text-danger confirm_dialog"
                                                        data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Detete')); ?>"
                                                        href="#"> <i data-feather="trash-2"></i></a>
                                                <?php endif; ?>
                                                <?php echo Form::close(); ?>

                                            </div>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\society\resources\views/expense/index.blade.php ENDPATH**/ ?>