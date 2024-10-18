@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/posts.edit_post')}} {{ config('app.locale') =='en' ? $post->title_en : $post->title }}</h6>
            <div class="ml-auto">
                <a href="{{route('admin.posts.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{__('Backend/posts.posts')}}</span>
                </a>
            </div>
        </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td colspan="4"><a href="{{route('admin.posts.show', $post->id)}}">{{  $post->title() }}</a></td>
                        </tr>
                        <tr>
                            <th>{{__('Backend/posts.status')}}</th>
                            <td>{{ $post->status() }}</td>
                        </tr>
                        <tr>
                            <th>{{__('Backend/posts.category')}}</th>
                            <td>{{ $post->category->name()}}</td>
                            <th>{{__('Backend/posts.author')}}</th>
                            <td>{{ $post->user->name}}</td>
                        </tr>
                        <tr>
                            <th>{{__('Backend/posts.created_at')}}</th>
                            <td>{{ config('app.locale') == 'en' ? $post->created_at ->format('d-m-Y h:i a') :   $post->created_at->locale('ar')->translatedFormat('d-m-Y h:i a') }}</td>
                            <th></th>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="row">
                                    @if($post->media->count() > 0)
                                        @foreach($post->media as $media)
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
