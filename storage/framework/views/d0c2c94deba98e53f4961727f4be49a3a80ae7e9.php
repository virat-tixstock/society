<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Member Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>">
                <?php echo e(__('Dashboard')); ?>

            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('member.index')); ?>"><?php echo e(__('Member')); ?></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="javascript:void(0)"> <?php echo e(__('Detail')); ?></a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">

        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h4><?php echo e(__('Member Details')); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <b><?php echo e(__('Name')); ?></b>
                                <p class="mb-20"><?php echo e($member->name); ?> </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <b><?php echo e(__('Email')); ?></b>
                                <p class="mb-20"><?php echo e($member->email); ?> </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <b><?php echo e(__('Phone No.')); ?></b>
                                <p class="mb-20"><?php echo e($member->phone_no); ?> </p>
                            </div>
                        </div>
                        
                        
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <b><?php echo e(__('Unit')); ?></b>
                                <p class="mb-20"><?php echo e(!empty($member->Unit) ?  $member->Unit->unit_number : ''); ?></p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <b><?php echo e(__('Profile')); ?></b>
                                <a href="<?php echo e(Storage::url($member->image)); ?>" class="text-warning" target="_blank"> <i
                                        data-feather="eye"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <b><?php echo e(__('Document')); ?></b>
                                <a href="<?php echo e(Storage::url($member->document)); ?>" class="text-warning" target="_blank"> <i
                                        data-feather="eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-12 col-lg-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5><?php echo e(__('Family Member List')); ?></h5>
                        </div>
                        <?php if(Gate::check('create member')): ?>
                            <div class="col-auto">
                                <a href="#" class="btn btn-secondary customModal" data-size="md"
                                    data-url="<?php echo e(route('member-detail.create', $member->id)); ?>"
                                    data-title="<?php echo e(__('Add Family Member')); ?>"> <i
                                        class="ti ti-circle-plus align-text-bottom"></i>
                                    <?php echo e(__('Create Member')); ?></a>
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
                                    <th><?php echo e(__('Email')); ?></th>
                                    <th><?php echo e(__('Phone No.')); ?></th>
                                    <th class="text-right"><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 wid-40">
                                                    <img class="img-radius img-fluid wid-40"
                                                        src="<?php echo e(Storage::url($detail->image)); ?>" alt="User image">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="mb-1">
                                                        <?php echo e($detail->name); ?>


                                                    </h5>
                                                    <p class="text-muted f-12 mb-0">
                                                        <?php echo e(!empty($user->phone_number) ? $user->phone_number : ''); ?> </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?php echo e($detail->email); ?> </td>
                                        <td><?php echo e($detail->phone_no); ?> </td>
                                        <td>
                                            <div class="cart-action">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['member-detail.destroy', $detail->id]]); ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit member')): ?>
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary customModal"
                                                        href="#"
                                                        data-url="<?php echo e(route('member-detail.edit', [$member->id, $detail->id])); ?>"
                                                        data-size="md" data-title="<?php echo e(__('Edit Family Member')); ?>"> <i
                                                            data-feather="edit"></i></a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete member')): ?>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\society\resources\views/member/show.blade.php ENDPATH**/ ?>