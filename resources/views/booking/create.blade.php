@extends('layouts.app')
@section('page-title')
    {{ __('Book Facility') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('booking-facility.index') }}">{{ __('Book Facility') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('Create') }}</li>
@endsection
@section('content')
    <div class="row mt-4">
        {{ Form::open(['url' => 'booking-facility', 'method' => 'post', 'id' => 'book_form']) }}
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="info-group">
                        <div class="row">

                            {{-- <div class="form-group col-md-4 building_id">
                                {{ Form::label('building_id', __('Building'), ['class' => 'form-label']) }}
                                {!! Form::select('building_id', $building, null, [
                                    'class' => 'form-control select2',
                                    'required' => 'required',
                                ]) !!}
                            </div> --}}
                            <div class="form-group col-lg-4 col-md-4">
                                {{ Form::label('member_id', __('member'), ['class' => 'form-label']) }}
                                {{Form::text('member_name',null,array('class'=>'form-control','placeholder'=>__('Enter member name')))}}
                                {{-- {!! Form::select('member_id', $member, null, ['class' => 'form-control select2', 'required' => 'required']) !!} --}}
                            </div>
                            <div class="form-group col-lg-4 col-md-4">
                                {{ Form::label('status', __('Status'), ['class' => 'form-label']) }}
                                {!! Form::select('status', ['Unpaid' => 'Unpaid', 'Paid' => 'Paid'], null, [
                                    'class' => 'form-control select2',
                                    'required' => 'required',
                                ]) !!}
                            </div>
                            <div class="form-group col-lg-4 col-md-4">
                                {{ Form::label('', __('Address'), ['class' => 'form-label']) }}
                                {{ Form::textarea('address', null, ['class' => 'form-control note', 'rows' => 1, 'placeholder' => __('Enter address')]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card location">
                <div class="card-header">
                    <h4>{{ 'Facility' }}</h4>
                </div>
                <div class="card-body">
                    <div class="row location_list">

                        <div class="form-group col-lg-3 col-md-3">
                            {{ Form::label('', __('facility'), ['class' => 'form-label']) }}
                            {!! Form::select('facility[]', $facility, null, [
                                'class' => 'form-control select2 facility',
                                'required' => 'required',
                            ]) !!}
                        </div>
                        <div class="form-group col-md-3 col-lg-3">
                            {{ Form::label('', __('Start Date'), ['class' => 'form-label']) }}
                            {{-- {{ Form::date('start_date[]', null, ['class' => 'form-control start_date']) }} --}}
                            {{ Form::input('datetime-local', 'start_date[]', null, ['class' => 'form-control start_date']) }}
                        </div>
                        <div class="form-group col-md-3 col-lg-3">
                            {{ Form::label('', __('End Date'), ['class' => 'form-label']) }}
                            {{-- {{ Form::date('end_date[]', null, ['class' => 'form-control end_date']) }} --}}
                            {{ Form::input('datetime-local', 'end_date[]', null, ['class' => 'form-control end_date']) }}
                        </div>
                        
                        <div class="form-group col-lg-2 col-md-2">
                            {{ Form::label('', __('Total Cost'), ['class' => 'form-label']) }}
                            {{ Form::number('total_cost[]', null, ['class' => 'form-control total_cost', 'placeholder' => __('Enter total cost'), 'required' => 'required']) }}
                        </div>
                        {{-- <div class="col-1 m-auto">
                            <a href="javascript:void(0)" class="fs-20 text-danger location_list_remove btn-sm "> <i
                                    data-feather="trash-2"></i></a>
                        </div> --}}
                    </div>
                    <div class="row location_list">
                        <div class="form-group col-md-3 col-lg-3">
                            {{ Form::label('', __('Deposite Date'), ['class' => 'form-label']) }}
                            {{ Form::date('deposite_date[]', null, ['class' => 'form-control end_date']) }}
                            {{-- {{ Form::input('datetime-local', 'deposite_date[]', null, ['class' => 'form-control deposite_date']) }} --}}
                        </div>
                        <div class="form-group col-lg-2 col-md-2">
                            {{ Form::label('', __('Deposite Cost'), ['class' => 'form-label']) }}
                            {{ Form::number('deposite_cost[]', null, ['class' => 'form-control total_cost', 'placeholder' => __('Enter deposite cost'), 'required' => 'required']) }}
                        </div>
                        @php
                            $payType = ["Cheque"=>'Cheque',"UPI"=>'UPI'];
                        @endphp
                        <div class="form-group col-lg-3 col-md-3">
                            {{ Form::label('', __('Payment Type'), ['class' => 'form-label']) }}
                            {!! Form::select('payment_type[]', $payType, null, [
                                'class' => 'form-control select2 paytype',
                                'required' => 'required',
                            ]) !!}
                        </div>
                        <div class="form-group col-lg-4 col-md-4">
                            {{ Form::label('', __('payment receive note'), ['class' => 'form-label']) }}
                            {{ Form::textarea('note[]', null, ['class' => 'form-control note', 'rows' => 1, 'placeholder' => __('Enter note')]) }}
                        </div>
                    </div>
                    <div class="location_list_results"></div>
                    {{-- <div class="row ">
                        <div class="col-sm-12">
                            <a href="javascript:void(0)" class="btn btn-secondary btn-xs location_clone "><i
                                    class="ti ti-plus"></i></a>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="group-button text-end">
                {{ Form::submit(__('Create'), ['class' => 'btn btn-secondary btn-rounded', 'id' => 'invoice-submit']) }}
            </div>
        </div>
        {{ Form::close() }}

    </div>
@endsection
@push('script-page')
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
                    url: "{{ route('get.member') }}",
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
                    url: "{{ route('get.facility.cost') }}",
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
@endpush
