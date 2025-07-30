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
            <a href="<?php echo e(route('booking-facility.index')); ?>"><?php echo e(__('Book facility')); ?></a>
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

                                        <p class="mb-0"><?php echo e(bookingPrefix() . $booking->booking_id); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0"><?php echo e(__('From')); ?>:</h6>
                                    <h5><?php echo e($settings['company_name']); ?></h5>
                                    <p class="mb-0"><?php echo e($settings['company_phone']); ?></p>
                                    <p class="mb-0"><?php echo e($settings['company_email']); ?></p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0"><?php echo e(__('To')); ?>:</h6>
                                    <h5><?php echo e(!empty($booking->Building) ? $booking->Building->name : ''); ?></h5>
                                    <h5><?php echo !empty($booking->member_name) ? $booking->member_name.'<br>'.$booking->address : ''; ?></h5>
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
                                                <th><?php echo e(__('Facility')); ?></th>
                                                <th><?php echo e(__('Start date')); ?></th>
                                                <th><?php echo e(__('end date')); ?></th>
                                                <th><?php echo e(__('rent')); ?></th>
                                                <th><?php echo e(__('Deposite date')); ?></th>
                                                <th><?php echo e(__("Deposite Amount")); ?></th>
                                                <th><?php echo e(__("Payment Type")); ?></th>
                                                <th><?php echo e(__("Payment Note")); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $total = 0;
                                                $deposite = 0;
                                            ?>
                                            <?php $__currentLoopData = $booking->BookingDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $total += $detail->total_cost;
                                                    $deposite +=$detail->deposite_cost;
                                                ?>
                                                <tr>
                                                    <td><?php echo e(!empty($detail->Facility) ? $detail->Facility->name : '-'); ?>

                                                    </td>
                                                    <td><?php echo e(dateFormat($detail->start_date)." ".timeFormat($detail->start_date)); ?></td>
                                                    <td><?php echo e(dateFormat($detail->end_date)." ".timeFormat($detail->end_date)); ?></td>
                                                    <td><?php echo e(priceFormat($detail->total_cost)); ?></td>
                                                    <td><?php echo e(dateFormat($detail->deposite_date)); ?></td>
                                                    <td><?php echo e(priceFormat($detail->deposite_cost)); ?></td>
                                                    <td><?php echo e($detail->payment_type); ?></td>
                                                    <td><?php echo e(($detail->note)); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50" />
                                </div>
                            </div>
                            <?php
                                $mainentance_details = $booking->BookingDetail[0]->maintenance_charges ? json_decode($booking->BookingDetail[0]->maintenance_charges,true) : [];
                                $charges = 0;
                            ?>
                            <?php if(!empty($mainentance_details)): ?>
                            <div class="col-12">
                                <div class="h4">
                                    <?php echo e(__('Charges')); ?>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th><?php echo e(__('Maintenance Type')); ?></th>
                                                <th><?php echo e(__('Charges')); ?></th>
                                                <th><?php echo e(__('Note')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
                                            <?php $__currentLoopData = $mainentance_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($detail['type']); ?> </td>
                                                    <td><?php echo e(priceFormat($detail['amount'])); ?></td>
                                                    <td><?php echo e($detail['type']); ?></td>
                                                <?php
                                                    $charges += $detail['amount'];
                                                ?>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50" />
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="col-12">
                                <div class="invoice-total ms-auto">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="f-w-600 mb-1 text-start"><?php echo e(__('Deposite Amount')); ?> :</p>
                                            <p class="f-w-600 mb-1 text-start"><?php echo e(__('Total Rent Amount')); ?> :</p>
                                            <?php if(!empty($mainentance_details)): ?>
                                                <p class="f-w-600 mb-1 text-start"><?php echo e(__('Total Charges')); ?> :</p>
                                            <?php endif; ?>
                                            <?php if($booking->status == "Paid"): ?>
                                            <p class="f-w-600 mb-1 text-start"><?php echo e(__('Total amount to be paid')); ?> :</p>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-6">
                                            <p class="f-w-600 mb-1 text-end">
                                                <?php echo e(priceFormat($deposite)); ?>

                                            </p>
                                            <p class="f-w-600 mb-1 text-end">
                                                <?php echo e(priceFormat($total)); ?>

                                            </p>
                                            <?php if(!empty($mainentance_details)): ?>
                                            <p class="f-w-600 mb-1 text-end">
                                                <?php echo e(priceFormat($charges)); ?>

                                            </p>
                                            <?php endif; ?>
                                            <?php if($booking->status == "Paid"): ?>
                                            <p class="f-w-600 mb-1 text-end">
                                                <?php echo e(priceFormat($deposite -  $total - $charges)); ?>

                                            </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <?php if($booking->status != "Paid"): ?>
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                
                                    <?php echo $__env->make('booking.rules', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
               <?php endif; ?>
                <div class="card">
                  
                        <div class="col-12">
                            <style>
                                .signature-container {
                                display: flex;
                                justify-content: space-between;
                                margin-top: 10px;
                                padding: 0 15px;
                                }

                                .signature-box {
                                width: 20%;
                                text-align: center;
                                }

                                .line {
                                border-bottom: 1px solid #000;
                                margin-bottom: 5px;
                                height: 30px;
                                }

                                .label {
                                font-weight: bold;
                                }
                                .important {
                                    font-weight: bold;
                                    color: #d6336c;
                                }   
                            </style>
                            <div class="signature-container">
                                <div class="signature-box">
                                    <div class="line"></div>
                                    <div class="label important">હોલ ભાડે આપનારની સહી</div>
                                </div>
                                <div class="signature-box">
                                    <div class="line"></div>
                                    <div class="label important">હોલ ભાડે રાખનારની સહી</div>
                                </div>
                            </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\society\resources\views/booking/show.blade.php ENDPATH**/ ?>