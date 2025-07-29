@extends('layouts.app')
@section('page-title')
    {{ __('Parking Slot') }}
@endsection

@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">
                {{ __('Dashboard') }}
            </a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{ __('Parking Slot') }}</a>
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
                            <h5>{{ __('Parking Slot List') }}</h5>
                        </div>
                        @if (Gate::check('create parking slot'))
                            <div class="col-auto">
                                <a href="#" class="btn btn-secondary customModal" data-size="md"
                                    data-url="{{ route('parking-slot.create') }}"
                                    data-title="{{ __('Create Parking Slot') }}"> <i
                                        class="ti ti-circle-plus align-text-bottom"></i>
                                    {{ __('Create Parking Slot') }}</a>
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
                                    <th>{{ __('status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($slots as $slot)
                                    <tr>
                                        <td>{{ $slot->name }}</td>
                                        <td>{{ $slot->type }}</td>
                                        <td>
                                            @if ($slot->status == 'Allocated')
                                                <span class="badge text-bg-success">
                                                    {{ $slot->status }}
                                                </span>
                                            @else
                                                <span class="badge text-bg-danger">
                                                    {{ $slot->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <div class="cart-action">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['parking-slot.destroy', $slot->id]]) !!}
                                                @can('edit parking slot')
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary customModal"
                                                        data-bs-toggle="tooltip" data-size="md"
                                                        data-bs-original-title="{{ __('Edit') }}" href="#"
                                                        data-url="{{ route('parking-slot.edit', $slot->id) }}"
                                                        data-title="{{ __('Edit parking slot') }}"><i
                                                            data-feather="edit"></i></a>
                                                @endcan
                                                @can('delete parking slot')
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
