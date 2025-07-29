@extends('layouts.app')
@section('page-title')
    {{ __('Member Details') }}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">
                {{ __('Dashboard') }}
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('member.index') }}">{{ __('Member') }}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="javascript:void(0)"> {{ __('Detail') }}</a>
        </li>
    </ul>
@endsection
@section('content')
    <div class="row">

        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h4>{{ __('Member Details') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <b>{{ __('Name') }}</b>
                                <p class="mb-20">{{ $member->name }} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <b>{{ __('Email') }}</b>
                                <p class="mb-20">{{ $member->email }} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <b>{{ __('Phone No.') }}</b>
                                <p class="mb-20">{{ $member->phone_no }} </p>
                            </div>
                        </div>
                        {{-- <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <b>{{ __('Building') }}</b>
                                <p class="mb-20">{{ !empty($member->Building) ? $member->Building->name : '' }} </p>
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <b>{{ __('Floor') }}</b>
                                <p class="mb-20">{{ !empty($member->Floor) ? $member->Floor->name : '' }} </p>
                            </div>
                        </div> --}}
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <b>{{ __('Unit') }}</b>
                                <p class="mb-20">{{ !empty($member->Unit) ?  $member->Unit->unit_number : '' }}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <b>{{ __('Profile') }}</b>
                                <a href="{{ Storage::url($member->image) }}" class="text-warning" target="_blank"> <i
                                        data-feather="eye"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <b>{{ __('Document') }}</b>
                                <a href="{{ Storage::url($member->document) }}" class="text-warning" target="_blank"> <i
                                        data-feather="eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h4>{{ __('vehicle Details') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (!empty($member->Unit) && !empty($member->Unit->Parking))
                        @foreach ($member->Unit->Parking as $item)
                            <div class="row">
                                <div class="col-md-3 col-lg-3">
                                    <div class="detail-group">
                                        <b>{{ __('Parking Slot') }}</b>
                                        <p class="mb-20">
                                            {{ !empty($item->ParkingSlot) ? $item->ParkingSlot->name : '' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <div class="detail-group">
                                        <b>{{ __('Vehicle number') }}</b>
                                        <p class="mb-20">
                                            {{ !empty($item) ? $item->vehicle_number : '' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <div class="detail-group">
                                        <b>{{ __('Phone No.') }}</b>
                                        <p class="mb-20">
                                            {{ !empty($item) ? $item->vehicle_model : '' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <div class="detail-group">
                                        <b>{{ __('Description') }}</b>
                                        <p class="mb-20">
                                            {{ !empty($item) ? $item->description : '' }}
                                        </p>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div> --}}
        <div class="col-md-12 col-lg-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>{{ __('Family Member List') }}</h5>
                        </div>
                        @if (Gate::check('create member'))
                            <div class="col-auto">
                                <a href="#" class="btn btn-secondary customModal" data-size="md"
                                    data-url="{{ route('member-detail.create', $member->id) }}"
                                    data-title="{{ __('Add Family Member') }}"> <i
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
                                    <th class="text-right">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $detail)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 wid-40">
                                                    <img class="img-radius img-fluid wid-40"
                                                        src="{{ Storage::url($detail->image) }}" alt="User image">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="mb-1">
                                                        {{ $detail->name }}

                                                    </h5>
                                                    <p class="text-muted f-12 mb-0">
                                                        {{ !empty($user->phone_number) ? $user->phone_number : '' }} </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $detail->email }} </td>
                                        <td>{{ $detail->phone_no }} </td>
                                        <td>
                                            <div class="cart-action">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['member-detail.destroy', $detail->id]]) !!}
                                                @can('edit member')
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary customModal"
                                                        href="#"
                                                        data-url="{{ route('member-detail.edit', [$member->id, $detail->id]) }}"
                                                        data-size="md" data-title="{{ __('Edit Family Member') }}"> <i
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
        {{-- <div class="col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h4>{{ __('Doctor Schedule') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @php
                            $work = $member->workSchedule;
                            $availability = json_decode($work->availability, true);
                        @endphp
                        @foreach ($days as $key => $day)
                            <div class="row">
                                <div class="form-group col-md-4 col-lg-4">
                                    {{ Form::label('day', __('Day'), ['class' => 'form-label']) }}
                                    {{ Form::text('availability[' . $key . '][day]', $day, ['class' => 'form-control', 'placeholder' => __('Enter day'), 'disabled']) }}
                                </div>
                                <div class="form-group col-md-4 col-lg-4">
                                    {{ Form::label('start_time', __('Start Time'), ['class' => 'form-label']) }}
                                    {{ Form::time('availability[' . $key . '][start_time]', !empty($availability) ? $availability[$day]['start_time'] : null, ['class' => 'form-control', 'disabled']) }}
                                </div>
                                <div class="form-group col-md-4 col-lg-4">
                                    {{ Form::label('end_time', __('End Time'), ['class' => 'form-label']) }}
                                    {{ Form::time('availability[' . $key . '][end_time]', !empty($availability) ? $availability[$day]['end_time'] : null, ['class' => 'form-control', 'disabled']) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
