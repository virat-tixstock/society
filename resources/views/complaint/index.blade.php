@extends('layouts.app')
@section('page-title')
    {{ __('Complaint') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('Complaint') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>{{ __('Complaint List') }}</h5>
                        </div>
                        @if (Gate::check('create complaint'))
                            <div class="col-auto">
                                <a href="#" class="btn btn-secondary customModal" data-size="lg"
                                    data-url="{{ route('complaint.create') }}" data-title="{{ __('Create Complaint') }}"> <i
                                        class="ti ti-circle-plus align-text-bottom"></i>
                                    {{ __('Create Complaint') }}</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Nature') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Member') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th class="text-right">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($complaints as $complaint)
                                    <tr>
                                        <td>{{ $complaint->title }} </td>
                                        <td>{{ $complaint->nature }} </td>
                                        <td>{{ $complaint->type }} </td>
                                        <td>{{ !empty($complaint->ComplaintCategory) ? $complaint->ComplaintCategory->title : '' }}
                                        </td>
                                        <td>{{ !empty($complaint->Member) ? $complaint->Member->name : '' }} </td>
                                        <td>{{ dateFormat($complaint->date) }} </td>
                                        <td>
                                            @if ($complaint->status == 'Under Review')
                                                <span
                                                 class="badge text-bg-warning">
                                                    {{ $complaint->status }}
                                                </span>
                                            @elseif ($complaint->status == 'Closed')
                                                <span class="badge text-bg-danger">
                                                    {{ $complaint->status }}
                                                </span>
                                            @elseif ($complaint->status == 'On Hold')
                                                <span class="badge text-bg-info">
                                                    {{ $complaint->status }}
                                                </span>
                                            @elseif ($complaint->status == 'Scheduled')
                                                <span class="badge text-bg-secondary">
                                                    {{ $complaint->status }}
                                                </span>
                                            @elseif ($complaint->status == 'Completed')
                                                <span class="badge text-bg-success">
                                                    {{ $complaint->status }}
                                                </span>
                                            @else
                                                <span class="badge text-bg-primary">
                                                    {{ $complaint->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="cart-action">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['complaint.destroy', $complaint->id]]) !!}
                                                @can('show complaint')
                                                    <a class="avtar avtar-xs btn-link-warning text-warning customModal"
                                                        href="#" data-url="{{ route('complaint.show', $complaint->id) }}"
                                                        data-size="lg" data-title="{{ __('Show Complaint') }}"> <i
                                                            data-feather="eye"></i></a>
                                                @endcan
                                                @can('edit complaint')
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary customModal"
                                                        href="#" data-url="{{ route('complaint.edit', $complaint->id) }}"
                                                        data-size="lg" data-title="{{ __('Edit complaint') }}"> <i
                                                            data-feather="edit"></i></a>
                                                @endcan
                                                @can('delete complaint')
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
