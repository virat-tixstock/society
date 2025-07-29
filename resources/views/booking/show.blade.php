@extends('layouts.app')
@section('page-title')
    {{ __('Details') }}
@endsection

@php
    $admin_logo = getSettingsValByName('company_logo');
    $settings = settings();
@endphp
@push('script-page')
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
@endpush
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">
                {{ __('Dashboard') }}
            </a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('booking-facility.index') }}">{{ __('Book facility') }}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{ __('Details') }}</a>
        </li>
    </ul>
@endsection
@section('content')
    <div class="row">
        <div id="po-print">
            <div class="col-sm-12">
                <div class="d-print-none card mb-3">
                    <div class="card-body p-3">
                        <ul class="list-inline ms-auto mb-0 d-flex justify-content-end flex-wrap">
                            <li class="list-inline-item align-bottom me-2">
                                <a href="#" class="avtar avtar-s btn-link-secondary print" data-bs-toggle="tooltip"
                                    data-bs-original-title="{{ __('Download') }}">
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
                                            <img src="{{ asset(Storage::url('upload/logo/')) . '/' . (isset($admin_logo) && !empty($admin_logo) ? $admin_logo : 'logo.png') }}"
                                                class="img-fluid brand-logo" alt="images" />
                                        </div>

                                        <p class="mb-0">{{ bookingPrefix() . $booking->booking_id }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">{{ __('From') }}:</h6>
                                    <h5>{{ $settings['company_name'] }}</h5>
                                    <p class="mb-0">{{ $settings['company_phone'] }}</p>
                                    <p class="mb-0">{{ $settings['company_email'] }}</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">{{ __('To') }}:</h6>
                                    <h5>{{ !empty($booking->Building) ? $booking->Building->name : '' }}</h5>
                                    <h5>{!! !empty($booking->member_name) ? $booking->member_name.'<br>'.$booking->address : '' !!}</h5>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="h4">
                                    {{ __('Details') }}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Facility') }}</th>
                                                <th>{{ __('Start date') }}</th>
                                                <th>{{ __('end date') }}</th>
                                                <th>{{ __('rent') }}</th>
                                                <th>{{ __('Deposite date') }}</th>
                                                <th>{{ __("Deposite Amount") }}</th>
                                                <th>{{ __("Payment Type") }}</th>
                                                <th>{{ __("Payment Note") }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total = 0;
                                                $deposite = 0;
                                            @endphp
                                            @foreach ($booking->BookingDetail as $detail)
                                                @php
                                                    $total += $detail->total_cost;
                                                    $deposite +=$detail->deposite_cost;
                                                @endphp
                                                <tr>
                                                    <td>{{ !empty($detail->Facility) ? $detail->Facility->name : '-' }}
                                                    </td>
                                                    <td>{{ dateFormat($detail->start_date)." ".timeFormat($detail->start_date) }}</td>
                                                    <td>{{ dateFormat($detail->end_date)." ".timeFormat($detail->end_date) }}</td>
                                                    <td>{{ priceFormat($detail->total_cost) }}</td>
                                                    <td>{{ dateFormat($detail->deposite_date) }}</td>
                                                    <td>{{ priceFormat($detail->deposite_cost) }}</td>
                                                    <td>{{ $detail->payment_type }}</td>
                                                    <td>{{ ($detail->note) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50" />
                                </div>
                            </div>
                            @php
                                $mainentance_details = $booking->BookingDetail[0]->maintenance_charges ? json_decode($booking->BookingDetail[0]->maintenance_charges,true) : [];
                                $charges = 0;
                            @endphp
                            @if(!empty($mainentance_details))
                            <div class="col-12">
                                <div class="h4">
                                    {{ __('Charges') }}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Maintenance Type') }}</th>
                                                <th>{{ __('Charges') }}</th>
                                                <th>{{ __('Note') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
                                            @foreach($mainentance_details as $detail)
                                                <tr>
                                                    <td>{{ $detail['type'] }} </td>
                                                    <td>{{ priceFormat($detail['amount']) }}</td>
                                                    <td>{{ $detail['type'] }}</td>
                                                @php
                                                    $charges += $detail['amount'];
                                                @endphp
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50" />
                                </div>
                            </div>
                            @endif
                            <div class="col-12">
                                <div class="invoice-total ms-auto">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="f-w-600 mb-1 text-start">{{ __('Deposite Amount') }} :</p>
                                            <p class="f-w-600 mb-1 text-start">{{ __('Total Rent Amount') }} :</p>
                                            @if(!empty($mainentance_details))
                                                <p class="f-w-600 mb-1 text-start">{{ __('Total Charges') }} :</p>
                                            @endif
                                            @if($booking->status == "Paid")
                                            <p class="f-w-600 mb-1 text-start">{{ __('Total amount to be paid') }} :</p>
                                            @endif
                                        </div>
                                        <div class="col-6">
                                            <p class="f-w-600 mb-1 text-end">
                                                {{ priceFormat($deposite) }}
                                            </p>
                                            <p class="f-w-600 mb-1 text-end">
                                                {{ priceFormat($total) }}
                                            </p>
                                            @if(!empty($mainentance_details))
                                            <p class="f-w-600 mb-1 text-end">
                                                {{ priceFormat($charges) }}
                                            </p>
                                            @endif
                                            @if($booking->status == "Paid")
                                            <p class="f-w-600 mb-1 text-end">
                                                {{ priceFormat($deposite -  $total - $charges) }}
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                @if($booking->status != "Paid")
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                
                                    @include('booking.rules')
                                
                            </div>
                        </div>
                    </div>
                </div>
               @endif
                <div class="card">
                    <div class="col-12">
                        <style>
                            .signature-container {
                            display: flex;
                            justify-content: space-between;
                            margin-top: 100px;
                            padding: 0 50px;
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
@endsection
