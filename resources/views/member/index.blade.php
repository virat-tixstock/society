@extends('layouts.app')

@section('page-title')
    {{ __('Member') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('Member') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>{{ __('Member List') }}</h5>
                        </div>
                        @if (Gate::check('create member'))
                            <div class="col-auto">
                                <a href="#" class="btn btn-secondary customModal" data-size="lg"
                                    data-url="{{ route('member.create') }}" data-title="{{ __('Create Member') }}"> <i
                                        class="ti ti-circle-plus align-text-bottom"></i>
                                    {{ __('Create Member') }}</a>
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
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Phone No.') }}</th>
                                    {{-- <th>{{ __('Building') }}</th> --}}
                                    {{-- <th>{{ __('Floor') }}</th> --}}
                                    <th>{{ __('Unit') }}</th>
                                    <th class="text-right">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($members as $member)
                                    <tr>
                                        <td>{{ $member->name }} </td>
                                        <td>{{ $member->email }} </td>
                                        <td>{{ $member->phone_no }} </td>
                                        {{-- <td>{{ !empty($member->Building) ? $member->Building->name : '' }} </td> --}}
                                        {{-- <td>{{ !empty($member->Floor) ? $member->Floor->name : '' }} </td>  --}}
                                        <td>{{ !empty($member->Unit) ?  $member->Unit->unit_number : '' }} </td>
                                        <td>
                                            <div class="cart-action">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['member.destroy', $member->id]]) !!}
                                                @can('show member')
                                                    <a class="avtar avtar-xs btn-link-warning text-warning"
                                                        href="{{ route('member.show', $member->id) }}"> <i
                                                            data-feather="eye"></i></a>
                                                @endcan
                                                @can('edit member')
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary customModal"
                                                        href="#" data-url="{{ route('member.edit', $member->id) }}"
                                                        data-size="lg" data-title="{{ __('Edit Member') }}"> <i
                                                            data-feather="edit"></i></a>
                                                @endcan
                                                @can('delete member')
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
