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
            <a href="{{ route('expense.index') }}">{{ __('Expense') }}</a>
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

                                        <p class="mb-0">{{ expensePrefix() . $expense->expense_id }}</p>
                                    </div>
                                    {{-- <div class="col-sm-6 text-sm-end">

                                        <h6>
                                            {{ __('Closing Date') }}
                                            <span
                                                class="text-muted f-w-400">{{ dateFormat($expense->closing_date) }}</span>
                                        </h6>
                                        <h6>
                                            {{ __('Current Stage') }}
                                            <span class="text-muted f-w-400">{{ $expense->stages->title }}</span>
                                        </h6>
                                        <h6>
                                            {{ __('Status') }}
                                            @if ($expense->payment_status == 'unpaid')
                                                <span
                                                    class="badge text-bg-danger">{{ $expense->payment_status }}</span>
                                            @elseif($expense->payment_status == 'partial_paid')
                                                <span
                                                    class="badge text-bg-warning">{{ $expense->payment_status }}</span>
                                            @else
                                                <span
                                                    class="badge text-bg-success">{{ $expense->payment_status }}</span>
                                            @endif

                                        </h6>
                                    </div> --}}
                                </div>
                            </div>
                            {{-- <div class="col-sm-6">
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
                                    <h5>{{ !empty($expense->Building) ? $expense->Building->name : '' }}</h5>
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <div class="h4">
                                    {{ __('Details') }}
                                </div>

                                {{-- <div class="row mt-3">
                                    <div class="col-4">
                                        <div><b>{{ __('Title') }}</b></div>
                                        <div>{{ $expense->title }}</div>
                                    </div>
                                    <div class="col-4">
                                        <div><b>{{ __('Company') }}</b></div>
                                        <div>
                                            {{ !empty($expense->Companies) ? $expense->Companies->name : '-' }}
                                        </div>
                                    </div>

                                    <div class="col-4 mt-4">
                                        <div><b>{{ __('Description') }}</b></div>
                                        <div>{{ $expense->description }}</div>
                                    </div>

                                </div> --}}
                            </div>


                            <div class="col-12">

                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Bill Type') }}</th>
                                                <th>{{ __('note') }}</th>
                                                <th>{{ __('Amount') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($expense->ExpenseDetails as $product)
                                                @php
                                                    $total += $product->amount;
                                                @endphp
                                                <tr>
                                                    <td>{{ !empty($product->ExpenseType) ? $product->ExpenseType->title : '-' }}
                                                    </td>
                                                    <td>{{ $product->note }}</td>
                                                    <td>{{ priceFormat($product->amount) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="invoice-total ms-auto">
                                    <div class="row">

                                        <div class="col-6">
                                            <p class="f-w-600 mb-1 text-start">{{ __('Total Amount') }} :</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="f-w-600 mb-1 text-end">
                                                {{ priceFormat($total) }}
                                            </p>
                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- @if ($pipelinePayment->count() > 0)
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <div class="h4">
                                    {{ __('Payment Details') }}
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Date') }}</th>
                                                <th>{{ __('Amount') }}</th>
                                                <th>{{ __('Method') }}</th>
                                                <th>{{ __('Notes') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pipelinePayment as $payment)
                                                <tr>
                                                    <td>{{ dateFormat($payment->payment_date) }}
                                                    </td>
                                                    <td>{{ priceFormat($payment->amount) }}</td>
                                                    <td>{{ $payment->method }}</td>
                                                    <td>{{ !empty($payment->notes) ? $payment->notes : '-' }}</td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50" />
                                </div>
                            </div>
                        </div>
                    </div>
                @endif --}}
            </div>
        </div>
    </div>
@endsection
