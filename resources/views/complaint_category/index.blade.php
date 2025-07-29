@extends('layouts.app')
@section('page-title')
    {{ __('Complaint Category') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('Complaint Category') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>{{ __('Complaint Category List') }}</h5>
                        </div>
                        @if (Gate::check('create complaint category'))
                            <div class="col-auto">
                                <a href="#" class="btn btn-secondary customModal" data-size="md"
                                    data-url="{{ route('complaint-category.create') }}"
                                    data-title="{{ __('Create Complaint Category') }}"> <i
                                        class="ti ti-circle-plus align-text-bottom"></i>
                                    {{ __('Create Complaint Category') }}</a>
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
                                    <th class="text-right">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($complaint_category as $category)
                                    <tr>
                                        <td>{{ $category->title }} </td>
                                        <td>
                                            <div class="cart-action">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['complaint-category.destroy', $category->id]]) !!}
                                                @can('edit complaint category')
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary customModal"
                                                        href="#"
                                                        data-url="{{ route('complaint-category.edit', $category->id) }}"
                                                        data-title="{{ __('Edit complaint Category') }}"> <i
                                                            data-feather="edit"></i></a>
                                                @endcan
                                                @can('delete complaint category')
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
