@extends('layouts.app')

@section('page-title')
    {{ __('Booking') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('Booking') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>{{ __('Booking List') }}</h5>
                        </div>
                        @if (Gate::check('create booking'))
                            <div class="col-auto">
                                <a class="btn btn-secondary " href="{{ route('booking-facility.create') }}"> <i
                                        class="ti ti-circle-plus align-text-bottom"></i>
                                    {{ __('Create Booking') }}</a>
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
                                    {{-- <th>{{ __('building') }}</th> --}}
                                    <th>{{ __('member') }}</th>
                                    <th>{{ __('Total') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th class="text-right">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{ bookingPrefix() . $booking->booking_id }}</td>
                                        {{-- <td>{{ $booking->Building ? $booking->Building->name : '' }} </td> --}}
                                        <td>{{ $booking->Member ? $booking->Member->name : $booking->member_name }} </td>
                                        <td>{{ !empty($booking->BookingDetail) ? number_format($booking->BookingDetail->sum('total_cost')) : 0 }}
                                        </td>
                                        <td>
                                            @if ($booking->status == 'Paid')
                                                <span class="badge text-bg-success">
                                                    {{ $booking->status }}
                                                </span>
                                            @else
                                                <span class="badge text-bg-danger">
                                                    {{ $booking->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="cart-action">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['booking-facility.destroy', $booking->id]]) !!}
                                                @can('show booking')
                                                    <a class="avtar avtar-xs btn-link-warning text-warning"
                                                        href="{{ route('booking-facility.show', $booking->id) }}"> <i
                                                            data-feather="eye"></i></a>
                                                @endcan
                                                @can('edit booking')
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary"
                                                        href="{{ route('booking-facility.edit', $booking->id) }}"> <i
                                                            data-feather="edit"></i></a>
                                                @endcan
                                                @can('delete booking')
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
