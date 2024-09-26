@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/announcements.announcements')}}</h6>
            <div class="ml-auto">
                <a href="{{route('admin.announcements.create')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">{{__('Backend/announcements.add_announcement')}}</span>
                </a>
            </div>
        </div>
        @include('backend.announcements.filter.filter')
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>{{__('Backend/announcements.title')}}</th>
                    <th>{{__('Backend/announcements.status')}}</th>
                    <th>{{__('Backend/announcements.user')}}</th>
                    <th>{{__('Backend/announcements.created_at')}}</th>
                    <th class="text-center" style="width:30px;">{{__('Backend/announcements.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($announcements as $announcement)
                    <tr>
                        <td><a href="{{route('admin.announcements.show', $announcement->id)}}">{{ $announcement->title() }}</a></td>
                        <td>{{ $announcement->status() }}</td>
                        <td>{{ $announcement->user->name}}</td>
                        <td>{{ config('app.locale') == 'en' ? $announcement->created_at ->format('d-m-Y h:i a') :   $announcement->created_at->locale('ar')->translatedFormat('d-m-Y h:i a') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{route('admin.announcements.edit', $announcement->id)}}" class="btn btn-primary"><i
                                            class="fa fa-edit"></i></a>
                                <a href="javascript:void(0);"
                                   onclick="if(confirm('{{__('Backend/announcements.are_you_sure')}} ')) { document.getElementById('announcement-delete-{{$announcement->id}}').submit(); } else { return false}"
                                   class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                <form action="{{route('admin.announcements.destroy', $announcement->id)}}" method="post"
                                      id="announcement-delete-{{$announcement->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">{{ __('Backend/announcements.no_announcements')}}</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="7">
                        <div class="float-right">
                            {!!  $announcements->appends(request()->input())->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
