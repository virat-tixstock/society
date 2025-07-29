@extends('layouts.app')

@section('page-title')
    {{ __('Unit') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('Unit') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>{{ __('Unit List') }}</h5>
                        </div>
                        @if (Gate::check('create unit'))
                            <div class="col-auto">
                                <a href="#" class="btn btn-secondary customModal" data-size="md"
                                    data-url="{{ route('unit.create') }}" data-title="{{ __('Create unit') }}"> <i
                                        class="ti ti-circle-plus align-text-bottom"></i>
                                    {{ __('Create unit') }}</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th>{{ __('Unit Number') }}</th>
                                    {{-- <th>{{ __('Building') }}</th> --}}
                                    {{-- <th>{{ __('Floor') }}</th> --}}
                                    <th>{{ __('Area(sqft)') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th class="text-right">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($units as $unit)
                                    <tr>
                                        <td>{{  $unit->unit_number }} </td>
                                        {{-- <td>{{ !empty($unit->Building) ? $unit->Building->name : '' }} </td> --}}
                                        {{-- <td>{{ !empty($unit->Floor) ? $unit->Floor->name : '' }} </td> --}}
                                        <td>{{ $unit->area }} </td>
                                        <td>{{ $unit->type }} </td>
                                        <td>
                                            @if ($unit->status == 'Rented')
                                                <span class="badge text-bg-success">
                                                    {{ $unit->status }}
                                                </span>
                                            @elseif ($unit->status == 'Occupied')
                                                <span class="badge text-bg-warning">
                                                    {{ $unit->status }}
                                                </span>
                                            @elseif ($unit->status == 'Available For Rent')
                                                <span class="badge text-bg-primary">
                                                    {{ $unit->status }}
                                                </span>
                                            @else
                                                <span class="badge text-bg-danger">
                                                    {{ $unit->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="cart-action">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['unit.destroy', $unit->id]]) !!}
                                                @can('edit unit')
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary customModal"
                                                        href="#" data-url="{{ route('unit.edit', $unit->id) }}"
                                                        data-title="{{ __('Edit Unit') }}"> <i data-feather="edit"></i></a>
                                                @endcan
                                                @can('delete unit')
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
