@extends('layouts.app')

@section('page-title')
    {{ __('Common Bill') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('Common Bill') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>{{ __('Common Bill List') }}</h5>
                        </div>
                        @if (Gate::check('create common bill'))
                            <div class="col-auto">
                                <a href="#" class="btn btn-secondary customModal" data-size="md"
                                    data-url="{{ route('common-bill.create') }}"
                                    data-title="{{ __('Create Common Bill') }}"> <i
                                        class="ti ti-circle-plus align-text-bottom"></i>
                                    {{ __('Create Common Bill') }}</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('amount') }}</th>
                                    <th>{{ __('date') }}</th>
                                    <th>{{ __('due date') }}</th>
                                    <th>{{ __('status') }}</th>
                                    <th class="text-right">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($commonBills as $bill)
                                    <tr>
                                        <td>{{ !empty($bill->BillType) ? $bill->BillType->title : '' }} </td>
                                        <td>{{ $bill->amount }}</td>
                                        <td>{{ dateFormat($bill->date) }}</td>
                                        <td>{{ dateFormat($bill->due_date) }}</td>
                                        <td>      @if ($bill->status == 'Paid')
                                                <span class="badge text-bg-success">
                                                    {{ $bill->status }}
                                                </span>
                                            @else
                                                <span class="badge text-bg-danger">
                                                    {{ $bill->status }}
                                                </span>
                                            @endif</td>
                                        <td>
                                            <div class="cart-action">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['common-bill.destroy', $bill->id]]) !!}
                                                @can('edit common bill')
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary customModal"
                                                        href="#" data-url="{{ route('common-bill.edit', $bill->id) }}"
                                                        data-title="{{ __('Edit Common Bill') }}"> <i
                                                            data-feather="edit"></i></a>
                                                @endcan
                                                @can('delete common bill')
                                                    <a class=" avtar avtar-xs btn-link-danger text-danger confirm_dialog"
                                                        data-bs-toggle="tooltip" data-bs-original-title="{{ __('Detete') }}"
                                                        href="#"> <i data-feather="trash-2"></i></a>
                                                @endcan
                                                {!! Form::close() !!}
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
