@extends('layouts.app')
@section('page-title')
    {{ __('Parking') }}
@endsection

@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">
                {{ __('Dashboard') }}
            </a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{ __('Parking') }}</a>
        </li>
    </ul>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>{{ __('Parking List') }}</h5>
                        </div>
                        @if (Gate::check('create parking'))
                            <div class="col-auto">
                                <a href="#" class="btn btn-secondary customModal" data-size="md"
                                    data-url="{{ route('parking.create') }}" data-title="{{ __('Create Parking') }}"> <i
                                        class="ti ti-circle-plus align-text-bottom"></i>
                                    {{ __('Create Parking') }}</a>
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
                                    <th>{{ __('type') }}</th>
                                    <th>{{ __('building') }}</th>
                                    <th>{{ __('unit') }}</th>
                                    <th>{{ __('Vehicle Number') }}</th>
                                    <th>{{ __('vehicle Model') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parkings as $parking)
                                    <tr>
                                        <td>{{ !empty($parking->ParkingSlot) ? $parking->ParkingSlot->name : '' }}</td>
                                        <td>{{ $parking->vehicle_type }}</td>
                                        <td>{{ !empty($parking->Building) ? $parking->Building->name : '' }}</td>
                                        <td>{{ !empty($parking->Unit) ? 100+$parking->Unit->unit_number : '' }}</td>
                                        <td>{{ $parking->vehicle_number }}</td>
                                        <td>{{ $parking->vehicle_model }}</td>
                                        <td class="text-right">
                                            <div class="cart-action">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['parking.destroy', $parking->id]]) !!}
                                                @can('edit parking')
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary customModal"
                                                        data-bs-toggle="tooltip" data-size="md"
                                                        data-bs-original-title="{{ __('Edit') }}" href="#"
                                                        data-url="{{ route('parking.edit', $parking->id) }}"
                                                        data-title="{{ __('Edit Parking') }}"><i data-feather="edit"></i></a>
                                                @endcan
                                                @can('delete parking')
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
