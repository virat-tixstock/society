<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Visitor')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item" aria-current="page"> <?php echo e(__('Visitor')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5><?php echo e(__('Visitor List')); ?></h5>
                        </div>
                        <?php if(Gate::check('create visitor')): ?>
                            <div class="col-auto">
                                <a href="#" class="btn btn-secondary customModal" data-size="lg"
                                    data-url="<?php echo e(route('visitor.create')); ?>" data-title="<?php echo e(__('Create Visitor')); ?>"> <i
                                        class="ti ti-circle-plus align-text-bottom"></i>
                                    <?php echo e(__('Create Visitor')); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Building')); ?></th>
                                    <th><?php echo e(__('Floor')); ?></th>
                                    <th><?php echo e(__('Unit')); ?></th>
                                    <th><?php echo e(__('Phone No.')); ?></th>
                                    <th><?php echo e(__('type')); ?></th>
                                    <th><?php echo e(__('visit Datetime')); ?></th>
                                    <th><?php echo e(__('end Datetime')); ?></th>
                                    <th class="text-right"><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $visitors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visitor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($visitor->visitor_name); ?> </td>
                                        <td><?php echo e(!empty($visitor->Building) ? $visitor->Building->name : ''); ?> </td>
                                        <td><?php echo e(!empty($visitor->Floor) ? $visitor->Floor->name : ''); ?> </td>
                                        <td><?php echo e(!empty($visitor->Unit) ? 100+$visitor->Unit->unit_number : ''); ?> </td>
                                        <td><?php echo e($visitor->phone_no); ?> </td>
                                        <td><?php echo e(!empty($visitor->VisitorType) ? $visitor->VisitorType->title : ''); ?> </td>
                                        <td><?php echo e(dateFormat($visitor->visit_datetime).' '.timeFormat($visitor->visit_datetime)); ?> </td>
                                        <td><?php echo e(dateFormat($visitor->end_datetime).' '.timeFormat($visitor->end_datetime)); ?> </td>
                                        <td>
                                            <div class="cart-action">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['visitor.destroy', $visitor->id]]); ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit visitor')): ?>
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary customModal"
                                                        href="#" data-url="<?php echo e(route('visitor.edit', $visitor->id)); ?>" data-size="lg"
                                                        data-title="<?php echo e(__('Edit visitor')); ?>"> <i data-feather="edit"></i></a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete visitor')): ?>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\society\resources\views/visitor/index.blade.php ENDPATH**/ ?>