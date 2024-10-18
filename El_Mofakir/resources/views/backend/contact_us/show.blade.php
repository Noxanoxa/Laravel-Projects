@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{ $message->tilte }}</h6>
            <div class="ml-auto">
                <a href="{{route('admin.contact_us.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">
                        {{__('Backend/contact_us.messages')}}
                    </span>
                </a>
            </div>
        </div>
            <div class="table-responsive">
                <table class="table table-hover">
                <tbody>
                    <tr>
                        <th>{{ __('Backend/contact_us.from') }}</th>
                        <td>{{ $message->title }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Backend/contact_us.title') }}</th>
                        <td>{{ $message->name }}<{{ $message->email }}></td>
                    </tr>
                    <tr>
                        <th>{{ __('Backend/contact_us.message') }}</th>
                        <td>{!!  $message->message  !!}</td>
                    </tr>
                </tbody>
                </table>
            </div>
    </div>
@endsection
