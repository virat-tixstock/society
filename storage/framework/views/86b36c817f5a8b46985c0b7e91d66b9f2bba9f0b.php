<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Unit')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item" aria-current="page"> <?php echo e(__('Unit')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5><?php echo e(__('Unit List')); ?></h5>
                        </div>
                        <?php if(Gate::check('create unit')): ?>
                            <div class="col-auto">
                                <a href="#" class="btn btn-secondary customModal" data-size="md"
                                    data-url="<?php echo e(route('unit.create')); ?>" data-title="<?php echo e(__('Create unit')); ?>"> <i
                                        class="ti ti-circle-plus align-text-bottom"></i>
                                    <?php echo e(__('Create unit')); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Unit Number')); ?></th>
                                    
                                    
                                    <th><?php echo e(__('Area(sqft)')); ?></th>
                                    <th><?php echo e(__('Type')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th class="text-right"><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($unit->unit_number); ?> </td>
                                        
                                        
                                        <td><?php echo e($unit->area); ?> </td>
                                        <td><?php echo e($unit->type); ?> </td>
                                        <td>
                                            <?php if($unit->status == 'Rented'): ?>
                                                <span class="badge text-bg-success">
                                                    <?php echo e($unit->status); ?>

                                                </span>
                                            <?php elseif($unit->status == 'Occupied'): ?>
                                                <span class="badge text-bg-warning">
                                                    <?php echo e($unit->status); ?>

                                                </span>
                                            <?php elseif($unit->status == 'Available For Rent'): ?>
                                                <span class="badge text-bg-primary">
                                                    <?php echo e($unit->status); ?>

                                                </span>
                                            <?php else: ?>
                                                <span class="badge text-bg-danger">
                                                    <?php echo e($unit->status); ?>

                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="cart-action">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['unit.destroy', $unit->id]]); ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit unit')): ?>
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary customModal"
                                                        href="#" data-url="<?php echo e(route('unit.edit', $unit->id)); ?>"
                                                        data-title="<?php echo e(__('Edit Unit')); ?>"> <i data-feather="edit"></i></a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete unit')): ?>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\society\resources\views/unit/index.blade.php ENDPATH**/ ?>