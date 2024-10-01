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
                            <th>{{__('Backend/posts.comments')}}</th>
                            <td>{{ $post->comment_able == 1 ? $post->comments->count() : __('Backend/posts.disallow') }}</td>
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

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/posts.comments')}}</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>{{__('Backend/posts.image')}}</th>
                    <th>{{__('Backend/posts.author')}}</th>
                    <th>{{__('Backend/posts.comment')}}</th>
                    <th>{{__('Backend/posts.status')}}</th>
                    <th>{{__('Backend/posts.created_at')}}</th>
                    <th class="text-center" style="width:30px;" >{{__('Backend/posts.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($post->comments as $comment)
                    <tr>
                        <td><img src="{{ get_gravatar($comment->email, 50)  }}" class="img-circle"></td>
                        <td>{{ $comment->name }}</td>
                        <td>{!! $comment->comment !!}</td>
                        <td>{{ $comment->status() }}</td>
                        <td>{{ config('app.locale') == 'en' ? $comment->created_at ->format('d-m-Y h:i a') :   $comment->created_at->locale('ar')->translatedFormat('d-m-Y h:i a') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{route('admin.post_comments.edit', $comment->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0);" onclick="if(confirm('{{__('Backend/post_comments.are_you_sure')}}')) { document.getElementById('comment-delete-{{$comment->id}}').submit(); } else { return false}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                <form action="{{route('admin.post_comments.destroy', $comment->id)}}"  method="post" id="comment-delete-{{$comment->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">{{__('Backend/posts.no_comments')}}</td>
                    </tr>

                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
