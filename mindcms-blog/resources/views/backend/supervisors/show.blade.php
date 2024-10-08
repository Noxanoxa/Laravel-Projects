@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Backend/supervisors.supervisor') }} {{ $user->name }}</h6>
            <div class="ml-auto">
                <a href="{{route('admin.users.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{ __('Backend/supervisors.supervisors') }}</span>
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <td colspan="4">
                        @if($user->user_image != '')
                            <img src="{{asset('assets/users/' . $user->user_image)}}" class="img-fluid">
                        @else
                            <img src="{{asset('assets/users/default.png')}}" class="img-fluid">
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>{{ __('Backend/supervisors.name') }}</th>
                    <td>{{ $user->name}} ({{ $user->username }})</td>
                    <th>{{ __('Backend/supervisors.email') }}</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>{{ __('Backend/supervisors.mobile') }}</th>
                    <td>{{ $user->mobile}}</td>
                    <th>{{ __('Backend/supervisors.status') }}</th>
                    <td>{{ $user->status()}}</td>
                </tr>
                <tr>
                    <th>{{ __('Backend/supervisors.created_at') }}</th>
                    <td>{{ $user->created_at ->format('d-m-Y h:i a')}}</td>
                    <th>{{ __('Backend/supervisors.posts_count') }}</th>
                    <td>{{ $user->posts_count }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
