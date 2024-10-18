@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/announcements.edit_announcement')}} {{ config('app.locale') =='en' ? $announcement->title_en : $announcement->title }}</h6>
            <div class="ml-auto">
                <a href="{{route('admin.announcements.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{__('Backend/announcements.announcements')}}</span>
                </a>
            </div>
        </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td colspan="4"><a href="{{route('admin.announcements.show', $announcement->id)}}">{{ config('app.locale') =='en' ? $announcement->title_en : $announcement->title }}</a></td>
                        </tr>
                        <tr>
                            <th>{{__('Backend/announcements.status')}}</th>
                            <td>{{ $announcement->status() }}</td>
                        </tr>
                        <tr>
                            <th>{{__('Backend/announcements.author')}}</th>
                            <td>{{ $announcement->user->name}}</td>
                        </tr>
                        <tr>
                            <th>{{__('Backend/announcements.created_at')}}</th>
                            <td>{{ config('app.locale') == 'en' ? $announcement->created_at ->format('d-m-Y h:i a') :   $announcement->created_at->locale('ar')->translatedFormat('d-m-Y h:i a') }}</td>
                            <th></th>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>

@endsection
