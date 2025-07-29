<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Book Facility')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('booking-facility.index')); ?>"><?php echo e(__('Book Facility')); ?></a></li>
    <li class="breadcrumb-item" aria-current="page"> <?php echo e(__('Create')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row mt-4">
        <?php echo e(Form::open(['url' => 'booking-facility', 'method' => 'post', 'id' => 'book_form'])); ?>

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="info-group">
                        <div class="row">

                            
                            <div class="form-group col-lg-4 col-md-4">
                                <?php echo e(Form::label('member_id', __('member'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('member_name',null,array('class'=>'form-control','placeholder'=>__('Enter member name')))); ?>

                                
                            </div>
                            <div class="form-group col-lg-4 col-md-4">
                                <?php echo e(Form::label('status', __('Status'), ['class' => 'form-label'])); ?>

                                <?php echo Form::select('status', ['Unpaid' => 'Unpaid', 'Paid' => 'Paid'], null, [
                                    'class' => 'form-control select2',
                                    'required' => 'required',
                                ]); ?>

                            </div>
                            <div class="form-group col-lg-4 col-md-4">
                                <?php echo e(Form::label('', __('Address'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::textarea('address', null, ['class' => 'form-control note', 'rows' => 1, 'placeholder' => __('Enter address')])); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card location">
                <div class="card-header">
                    <h4><?php echo e('Facility'); ?></h4>
                </div>
                <div class="card-body">
                    <div class="row location_list">

                        <div class="form-group col-lg-3 col-md-3">
                            <?php echo e(Form::label('', __('facility'), ['class' => 'form-label'])); ?>

                            <?php echo Form::select('facility[]', $facility, null, [
                                'class' => 'form-control select2 facility',
                                'required' => 'required',
                            ]); ?>

                        </div>
                        <div class="form-group col-md-3 col-lg-3">
                            <?php echo e(Form::label('', __('Start Date'), ['class' => 'form-label'])); ?>

                            
                            <?php echo e(Form::input('datetime-local', 'start_date[]', null, ['class' => 'form-control start_date'])); ?>

                        </div>
                        <div class="form-group col-md-3 col-lg-3">
                            <?php echo e(Form::label('', __('End Date'), ['class' => 'form-label'])); ?>

                            
                            <?php echo e(Form::input('datetime-local', 'end_date[]', null, ['class' => 'form-control end_date'])); ?>

                        </div>
                        
                        <div class="form-group col-lg-2 col-md-2">
                            <?php echo e(Form::label('', __('Total Cost'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::number('total_cost[]', null, ['class' => 'form-control total_cost', 'placeholder' => __('Enter total cost'), 'required' => 'required'])); ?>

                        </div>
                        
                    </div>
                    <div class="row location_list">
                        <div class="form-group col-md-3 col-lg-3">
                            <?php echo e(Form::label('', __('Deposite Date'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::date('deposite_date[]', null, ['class' => 'form-control end_date'])); ?>

                            
                        </div>
                        <div class="form-group col-lg-2 col-md-2">
                            <?php echo e(Form::label('', __('Deposite Cost'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::number('deposite_cost[]', null, ['class' => 'form-control total_cost', 'placeholder' => __('Enter deposite cost'), 'required' => 'required'])); ?>

                        </div>
                        <?php
                            $payType = ["Cheque"=>'Cheque',"UPI"=>'UPI'];
                        ?>
                        <div class="form-group col-lg-3 col-md-3">
                            <?php echo e(Form::label('', __('Payment Type'), ['class' => 'form-label'])); ?>

                            <?php echo Form::select('payment_type[]', $payType, null, [
                                'class' => 'form-control select2 paytype',
                                'required' => 'required',
                            ]); ?>

                        </div>
                        <div class="form-group col-lg-4 col-md-4">
                            <?php echo e(Form::label('', __('payment receive note'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::textarea('note[]', null, ['class' => 'form-control note', 'rows' => 1, 'placeholder' => __('Enter note')])); ?>

                        </div>
                    </div>
                    <div class="location_list_results"></div>
                    
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
            $(document).on('change input', '.facility, .start_date,.end_date', function() {
                let row = $(this).closest('.row');
                var facility = row.find('.facility').val();
                var start_date = row.find('.start_date').val();
                var end_date = row.find('.end_date').val();

                $.ajax({
                    url: "<?php echo e(route('get.facility.cost')); ?>",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        facility: facility,
                        start_date: start_date,
                        end_date: end_date,
                    },
                    type: 'POST',
                    success: function(data) {
                        row.find('.total_cost').val('');
                        row.find('.total_cost').val(data);
                    },
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\society\resources\views/booking/create.blade.php ENDPATH**/ ?>