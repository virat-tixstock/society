@extends('layouts.app')

@section('page-title')
    {{ __('Attendance') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('Attendance') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>{{ __('Attendance List') }}</h5>
                        </div>
                        @if (Gate::check('create attendance'))
                            <div class="col-auto">
                                <a href="#" class="btn btn-secondary customModal" data-size="md"
                                    data-url="{{ route('attendance.create') }}" data-title="{{ __('Create attendance') }}">
                                    <i class="ti ti-circle-plus align-text-bottom"></i>
                                    {{ __('Create attendance') }}</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('in date time') }}</th>
                                    <th>{{ __('out date time') }}</th>
                                    <th class="text-right">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendances as $attendance)
                                    <tr>
                                        <td>{{ !empty($attendance->User) ? $attendance->User->name : '' }} </td>
                                        <td>{{ dateFormat($attendance->in_datetime) . ' ' . timeFormat($attendance->in_datetime) }}
                                        </td>
                                        <td>{{ dateFormat($attendance->out_datetime) . ' ' . timeFormat($attendance->out_datetime) }}
                                        </td>
                                        <td>
                                            <div class="cart-action">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['attendance.destroy', $attendance->id]]) !!}
                                                @can('edit attendance')
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary customModal"
                                                        href="#"
                                                        data-url="{{ route('attendance.edit', $attendance->id) }}"
                                                        data-title="{{ __('Edit Attendance') }}"> <i
                                                            data-feather="edit"></i></a>
                                                @endcan
                                                @can('delete attendance')
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
