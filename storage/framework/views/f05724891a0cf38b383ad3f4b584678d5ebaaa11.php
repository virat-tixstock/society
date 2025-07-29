<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Complaint')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item" aria-current="page"> <?php echo e(__('Complaint')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5><?php echo e(__('Complaint List')); ?></h5>
                        </div>
                        <?php if(Gate::check('create complaint')): ?>
                            <div class="col-auto">
                                <a href="#" class="btn btn-secondary customModal" data-size="lg"
                                    data-url="<?php echo e(route('complaint.create')); ?>" data-title="<?php echo e(__('Create Complaint')); ?>"> <i
                                        class="ti ti-circle-plus align-text-bottom"></i>
                                    <?php echo e(__('Create Complaint')); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Title')); ?></th>
                                    <th><?php echo e(__('Nature')); ?></th>
                                    <th><?php echo e(__('Type')); ?></th>
                                    <th><?php echo e(__('Category')); ?></th>
                                    <th><?php echo e(__('Member')); ?></th>
                                    <th><?php echo e(__('Date')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th class="text-right"><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $complaints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complaint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($complaint->title); ?> </td>
                                        <td><?php echo e($complaint->nature); ?> </td>
                                        <td><?php echo e($complaint->type); ?> </td>
                                        <td><?php echo e(!empty($complaint->ComplaintCategory) ? $complaint->ComplaintCategory->title : ''); ?>

                                        </td>
                                        <td><?php echo e(!empty($complaint->Member) ? $complaint->Member->name : ''); ?> </td>
                                        <td><?php echo e(dateFormat($complaint->date)); ?> </td>
                                        <td>
                                            <?php if($complaint->status == 'Under Review'): ?>
                                                <span
                                                 class="badge text-bg-warning">
                                                    <?php echo e($complaint->status); ?>

                                                </span>
                                            <?php elseif($complaint->status == 'Closed'): ?>
                                                <span class="badge text-bg-danger">
                                                    <?php echo e($complaint->status); ?>

                                                </span>
                                            <?php elseif($complaint->status == 'On Hold'): ?>
                                                <span class="badge text-bg-info">
                                                    <?php echo e($complaint->status); ?>

                                                </span>
                                            <?php elseif($complaint->status == 'Scheduled'): ?>
                                                <span class="badge text-bg-secondary">
                                                    <?php echo e($complaint->status); ?>

                                                </span>
                                            <?php elseif($complaint->status == 'Completed'): ?>
                                                <span class="badge text-bg-success">
                                                    <?php echo e($complaint->status); ?>

                                                </span>
                                            <?php else: ?>
                                                <span class="badge text-bg-primary">
                                                    <?php echo e($complaint->status); ?>

                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="cart-action">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['complaint.destroy', $complaint->id]]); ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show complaint')): ?>
                                                    <a class="avtar avtar-xs btn-link-warning text-warning customModal"
                                                        href="#" data-url="<?php echo e(route('complaint.show', $complaint->id)); ?>"
                                                        data-size="lg" data-title="<?php echo e(__('Show Complaint')); ?>"> <i
                                                            data-feather="eye"></i></a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit complaint')): ?>
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary customModal"
                                                        href="#" data-url="<?php echo e(route('complaint.edit', $complaint->id)); ?>"
                                                        data-size="lg" data-title="<?php echo e(__('Edit complaint')); ?>"> <i
                                                            data-feather="edit"></i></a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete complaint')): ?>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\society\resources\views/complaint/index.blade.php ENDPATH**/ ?>