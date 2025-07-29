<div class="modal-body">
    <div class="product-card">
        <div class="row">
            <div class="col-6">
                <div class="detail-group">
                    <b>{{ __('Type') }}</b>
                    <p class="mb-20">{{ $complaint->type }}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <b>{{ __('Type') }}</b>
                    <p class="mb-20">{{ $complaint->type }}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <b>{{ __('Nature') }}</b>
                    <p class="mb-20">{{ $complaint->nature }}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <b>{{ __('Title') }}</b>
                    <p class="mb-20">{{ $complaint->title }}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <b>{{ __('Category') }}</b>
                    <p class="mb-20">
                        {{ !empty($complaint->ComplaintCategory) ? $complaint->ComplaintCategory->title : '' }}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <b>{{ __('Member') }}</b>
                    <p class="mb-20">{{ !empty($complaint->Member) ? $complaint->Member->name : '' }}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <b>{{ __('Date') }}</b>
                    <p class="mb-20">{{ dateFormat($complaint->date) }}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <b>{{ __('Status') }}</b>
                    <p class="mb-20">{{ $complaint->status }}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <b>{{ __('Note') }}</b>
                    <p class="mb-20">{{ $complaint->note }}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <b>{{ __('Document') }}</b>
                    <a href="{{ Storage::url($complaint->document) }}" target="_blank" class="text-warning"><i data-feather="eye"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
