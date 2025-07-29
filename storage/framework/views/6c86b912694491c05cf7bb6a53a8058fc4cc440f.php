<?php echo e(Form::open(['url' => 'complaint', 'method' => 'post', 'enctype' => 'multipart/form-data'])); ?>


<div class="modal-body">
    <div class="row">
        <div class="form-group ">
            <div class="col-md-12">
                <?php echo e(Form::label('nature', __('Nature'), ['class' => 'form-label'])); ?>

            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="nature" value="Complaint" id="Complaint" checked>
                <label class="form-check-label" for="Complaint"><?php echo e(__('Complaint')); ?></label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="nature" value="Suggestion" id="Suggestion">
                <label class="form-check-label" for="Suggestion"><?php echo e(__('Suggestion')); ?></label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="nature" value="Request" id="Request">
                <label class="form-check-label" for="Request"><?php echo e(__('Request')); ?></label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="nature" value="Maintenance Request"
                    id="Maintenance_Request">
                <label class="form-check-label" for="Maintenance_Request"><?php echo e(__('Maintenance Request')); ?></label>
            </div>
        </div>
        <div class="form-group ">
            <div class="col-md-12">
                <?php echo e(Form::label('Type', __('Type'), ['class' => 'form-label'])); ?>

            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="type" value="Individual" id="Individual"
                    checked>
                <label class="form-check-label" for="Individual"><?php echo e(__('Individual')); ?></label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="type" value="Compound" id="Compound">
                <label class="form-check-label" for="Compound"><?php echo e(__('Compound')); ?></label>
            </div>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('title', __('Title'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Enter title')])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('member_id', __('member'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::select('member_id', $member, null, ['class' => 'form-control select2'])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('category', __('category'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::select('category', $category, null, ['class' => 'form-control select2'])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('date', __('date'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::date('date', null, ['class' => 'form-control', 'placeholder' => __('Enter date')])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('document', __('document'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::file('document', ['class' => 'form-control'])); ?>

        </div>

        <div class="form-group col-md-6">
            <?php echo e(Form::label('status', __('Status'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::select('status', $status, null, ['class' => 'form-control select2'])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('note', __('note'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::textarea('note', null, ['class' => 'form-control','rows'=>2, 'placeholder' => __('Enter note')])); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <?php echo e(Form::submit(__('Create'), ['class' => 'btn btn-secondary btn-rounded'])); ?>

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\wamp64\www\society\resources\views/complaint/create.blade.php ENDPATH**/ ?>