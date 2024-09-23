@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('backend/pages.page')}} {{ $page->tilte }}</h6>
            <div class="ml-auto">
                <a href="{{route('admin.posts.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{__('backend/pages.pages')}}</span>
                </a>
            </div>
        </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td colspan="4"><a href="{{route('admin.posts.show', $page->id)}}">{{ $page->title }}</a></td>
                        </tr>
                        <tr>
                            <th>{{__('backend/pages.category')}}</th>
                            <td>{{ $page->category->name}}</td>
                            <th>{{__('backend/pages.status')}}</th>
                            <td>{{ $page->status() == 'Active'? __('Backend/pages.active') : __('Backend/pages.inactive') }}</td>
                        </tr>
                        <tr>
                            <th>{{__('backend/pages.author')}}</th>
                            <td>{{ $page->user->name}}</td>
                            <th>{{__('backend/pages.created_at')}}</th>
                            <td>{{ $page->created_at ->format('d-m-Y h:i a')}}</td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="row">
                                    @if($page->media->count() > 0)
                                        @foreach($page->media as $media)
                                            <div class="col-2">
                                                <img src="{{ asset('assets/posts/' . $media->file_name) }}" class="img-fluid">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>
@endsection
