@extends('layouts.app')

@section('page-title')
    {{ __('Expense') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('Expense') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>{{ __('Expense List') }}</h5>
                        </div>
                        @if (Gate::check('create expense'))
                            <div class="col-auto">
                                <a class="btn btn-secondary " href="{{ route('expense.create') }}"> <i
                                        class="ti ti-circle-plus align-text-bottom"></i>
                                    {{ __('Create Expense') }}</a>
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
                                    <th>{{ __('date') }}</th>
                                    <th>{{ __('Total Amount') }}</th>
                                    <th class="text-right">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expenses as $expense)
                                    <tr>
                                        <td>{{ expensePrefix() . $expense->expense_id }}</td>
                                        {{-- <td>{{ !empty($expense->Building) ? $expense->Building->name : '' }} </td> --}}
                                        <td>{{ dateFormat($expense->date) }}</td>
                                        <td>{{ !empty($expense->ExpenseDetails) ? priceFormat($expense->ExpenseDetails->sum('amount')) : 0 }}
                                        </td>
                                        <td>
                                            <div class="cart-action">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['expense.destroy', $expense->id]]) !!}
                                                @can('show expense')
                                                    <a class="avtar avtar-xs btn-link-warning text-warning"
                                                        href="{{ route('expense.show', $expense->id) }}"> <i
                                                            data-feather="eye"></i></a>
                                                @endcan
                                                @can('edit expense')
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary"
                                                        href="{{ route('expense.edit', $expense->id) }}"> <i
                                                            data-feather="edit"></i></a>
                                                @endcan
                                                @can('delete expense')
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
