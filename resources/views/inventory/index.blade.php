@extends('layouts.app')

@section('page-title')
    {{ __('Inventory') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('Inventory') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>{{ __('Inventory List') }}</h5>
                        </div>
                        @if (Gate::check('create inventory'))
                            <div class="col-auto">
                                <a href="#" class="btn btn-secondary customModal" data-size="md"
                                    data-url="{{ route('inventory.create') }}" data-title="{{ __('Create Inventory') }}"> <i
                                        class="ti ti-circle-plus align-text-bottom"></i>
                                    {{ __('Create Inventory') }}</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('Quantity') }}</th>
                                    <th>{{ __('amount') }}</th>
                                    <th class="text-right">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventories as $inventory)
                                    <tr>
                                        <td>{{ $inventory->name }}</td>
                                        <td>{{ $inventory->qty }}</td>
                                        <td>{{ priceFormat($inventory->amount) }}</td>
                                        <td>
                                            <div class="cart-action">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['inventory.destroy', $inventory->id]]) !!}
                                                @can('edit inventory')
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary customModal"
                                                        href="#" data-url="{{ route('inventory.edit', $inventory->id) }}"
                                                        data-title="{{ __('Edit Inventory') }}"> <i
                                                            data-feather="edit"></i></a>
                                                @endcan
                                                @can('delete inventory')
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
