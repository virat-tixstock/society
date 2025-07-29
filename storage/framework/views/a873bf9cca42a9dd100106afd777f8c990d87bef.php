<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Maintenance')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item">
        <a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
    </li>
    <li class="breadcrumb-item" aria-current="page"> <?php echo e(__('Maintenance')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5><?php echo e(__('Maintenance List')); ?></h5>
                        </div>
                        <?php if(Gate::check('create maintenance')): ?>
                            <div class="col-auto">
                                <a class="btn btn-secondary" href="<?php echo e(route('maintenance.create')); ?>"> <i
                                        class="ti ti-circle-plus align-text-bottom"></i>
                                    <?php echo e(__('Create Maintenance')); ?></a>
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
                                    
                                    <th><?php echo e(__('Member')); ?></th>
                                    <th><?php echo e(__('Month')); ?></th>
                                    <th><?php echo e(__('Total Amount')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th class="text-right"><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $maintenances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $maintenance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(maintenancePrefix() . $maintenance->maintenance_id); ?></td>
                                        
                                        <td><?php echo e(!empty($maintenance->Member) ? $maintenance->Member->name : ''); ?> </td>
                                        <td><?php echo e(monthList()[$maintenance->month]); ?></td>
                                        <td><?php echo e(priceFormat($maintenance->Details->sum('amount'))); ?></td>
                                        <td>
                                            <?php if($maintenance->status == 'Paid'): ?>
                                                <span class="badge text-bg-success">
                                                    <?php echo e($maintenance->status); ?>

                                                </span>
                                            <?php else: ?>
                                                <span class="badge text-bg-danger">
                                                    <?php echo e($maintenance->status); ?>

                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="cart-action">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['maintenance.destroy', $maintenance->id]]); ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show maintenance')): ?>
                                                    <a class="avtar avtar-xs btn-link-warning text-warning"
                                                        href="<?php echo e(route('maintenance.show', $maintenance->id)); ?>"> <i
                                                            data-feather="eye"></i></a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit maintenance')): ?>
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary"
                                                        href="<?php echo e(route('maintenance.edit', $maintenance->id)); ?>"> <i
                                                            data-feather="edit"></i></a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete maintenance')): ?>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\society\resources\views/maintenance/index.blade.php ENDPATH**/ ?>