@extends('layouts.app')

@section('page-title')
    {{ __('Maintenance') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('Maintenance') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>{{ __('Maintenance List') }}</h5>
                        </div>
                        @if (Gate::check('create maintenance'))
                            <div class="col-auto">
                                <a class="btn btn-secondary" href="{{ route('maintenance.create') }}"> <i
                                        class="ti ti-circle-plus align-text-bottom"></i>
                                    {{ __('Create Maintenance') }}</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    {{-- <th>{{ __('Building') }}</th> --}}
                                    <th>{{ __('Member') }}</th>
                                    <th>{{ __('Month') }}</th>
                                    <th>{{ __('Total Amount') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th class="text-right">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($maintenances as $maintenance)
                                    <tr>
                                        <td>{{ maintenancePrefix() . $maintenance->maintenance_id }}</td>
                                        {{-- <td>{{ !empty($maintenance->Building) ? $maintenance->Building->name : '' }} </td> --}}
                                        <td>{{ !empty($maintenance->Member) ? $maintenance->Member->name : '' }} </td>
                                        <td>{{ monthList()[$maintenance->month] }}</td>
                                        <td>{{ priceFormat($maintenance->Details->sum('amount')) }}</td>
                                        <td>
                                            @if ($maintenance->status == 'Paid')
                                                <span class="badge text-bg-success">
                                                    {{ $maintenance->status }}
                                                </span>
                                            @else
                                                <span class="badge text-bg-danger">
                                                    {{ $maintenance->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="cart-action">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['maintenance.destroy', $maintenance->id]]) !!}
                                                @can('show maintenance')
                                                    <a class="avtar avtar-xs btn-link-warning text-warning"
                                                        href="{{ route('maintenance.show', $maintenance->id) }}"> <i
                                                            data-feather="eye"></i></a>
                                                @endcan
                                                @can('edit maintenance')
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary"
                                                        href="{{ route('maintenance.edit', $maintenance->id) }}"> <i
                                                            data-feather="edit"></i></a>
                                                @endcan
                                                @can('delete maintenance')
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
