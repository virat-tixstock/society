@extends('layouts.app')
@section('page-title')
    {{ __('Tax') }}
@endsection

@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">
                {{ __('Dashboard') }}
            </a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{ __('Tax') }}</a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    @if (Gate::check('create tax'))
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="md" data-url="{{ route('tax.create') }}"
            data-title="{{ __('Add Tax') }}"> <i class="ti-plus mr-5"></i>
            {{ __('Create Tax') }}
        </a>
    @endif
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>{{ __('Tax List') }}</h5>
                        </div>
                        @if (Gate::check('create tax'))
                            <div class="col-auto">
                                <a href="#" class="btn btn-secondary customModal" data-size="md"
                                    data-url="{{ route('tax.create') }}" data-title="{{ __('Create Tax') }}"> <i
                                        class="ti ti-circle-plus align-text-bottom"></i>
                                    {{ __('Create Tax') }}</a>
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
                                    <th>{{ __('Rate') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($taxes as $tax)
                                    <tr>
                                        <td>{{ $tax->title }}</td>
                                        <td>{{ $tax->rate . '%' }}</td>
                                        <td class="text-right">
                                            <div class="cart-action">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['tax.destroy', $tax->id]]) !!}
                                                @can('edit tax')
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary customModal" data-bs-toggle="tooltip" data-size="md"
                                                        data-bs-original-title="{{ __('Edit') }}" href="#"
                                                        data-url="{{ route('tax.edit', $tax->id) }}"
                                                        data-title="{{ __('Edit Tax') }}"><i data-feather="edit"></i></a>
                                                @endcan
                                                @can('delete tax')
                                                    <a class=" avtar avtar-xs btn-link-danger text-danger confirm_dialog" data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Detete') }}" href="#"> <i
                                                            data-feather="trash-2"></i></a>
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
