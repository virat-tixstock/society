@extends('layouts.app')
@section('page-title')
    {{ __('Visitor') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('Visitor') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>{{ __('Visitor List') }}</h5>
                        </div>
                        @if (Gate::check('create visitor'))
                            <div class="col-auto">
                                <a href="#" class="btn btn-secondary customModal" data-size="lg"
                                    data-url="{{ route('visitor.create') }}" data-title="{{ __('Create Visitor') }}"> <i
                                        class="ti ti-circle-plus align-text-bottom"></i>
                                    {{ __('Create Visitor') }}</a>
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
                                    <th>{{ __('Building') }}</th>
                                    <th>{{ __('Floor') }}</th>
                                    <th>{{ __('Unit') }}</th>
                                    <th>{{ __('Phone No.') }}</th>
                                    <th>{{ __('type') }}</th>
                                    <th>{{ __('visit Datetime') }}</th>
                                    <th>{{ __('end Datetime') }}</th>
                                    <th class="text-right">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($visitors as $visitor)
                                    <tr>
                                        <td>{{ $visitor->visitor_name }} </td>
                                        <td>{{ !empty($visitor->Building) ? $visitor->Building->name : '' }} </td>
                                        <td>{{ !empty($visitor->Floor) ? $visitor->Floor->name : '' }} </td>
                                        <td>{{ !empty($visitor->Unit) ? 100+$visitor->Unit->unit_number : '' }} </td>
                                        <td>{{ $visitor->phone_no }} </td>
                                        <td>{{ !empty($visitor->VisitorType) ? $visitor->VisitorType->title : '' }} </td>
                                        <td>{{ dateFormat($visitor->visit_datetime).' '.timeFormat($visitor->visit_datetime) }} </td>
                                        <td>{{ dateFormat($visitor->end_datetime).' '.timeFormat($visitor->end_datetime) }} </td>
                                        <td>
                                            <div class="cart-action">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['visitor.destroy', $visitor->id]]) !!}
                                                @can('edit visitor')
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary customModal"
                                                        href="#" data-url="{{ route('visitor.edit', $visitor->id) }}" data-size="lg"
                                                        data-title="{{ __('Edit visitor') }}"> <i data-feather="edit"></i></a>
                                                @endcan
                                                @can('delete visitor')
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
