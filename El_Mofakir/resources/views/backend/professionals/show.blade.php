@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Backend/professionals.author') }} {{ $user->name }}</h6>
            <div class="ml-auto">
                <a href="{{route('admin.professionals.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{ __('Backend/professionals.authors') }}</span>
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
                    <th>{{ __('Backend/professionals.name') }}</th>
                    <td>{{ $user->name}} ({{ $user->username }})</td>
                    <th>{{ __('Backend/professionals.email') }}</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>{{ __('Backend/professionals.mobile') }}</th>
                    <td>{{ $user->mobile}}</td>
                    <th>{{ __('Backend/professionals.cv') }}</th>
                    <td>
                        @if($user->media && $user->media->where('file_type', 'application/pdf')->first())
                            <a href="{{ route('admin.professionals.download_cv', $user->id) }}" class="btn btn-primary">
                                {{ __('Backend/professionals.download_cv') }}
                            </a>
                        @else
                            <span class="text-danger">{{ __('Backend/professionals.no_cv') }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>{{ __('Backend/professionals.created_at') }}</th>
                    <td>{{ config('app.locale') == 'en' ? $user->created_at->format('d M Y h:i A') : $user->created_at->translatedFormat('d M Y h:i A') }}</td>
                    <th>{{ __('Backend/professionals.posts_count') }}</th>
                    <td>{{ $user->posts_count }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
