@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/post_comments.edit_comment')}} ( {{  $comment->name }})</h6>
            <div class="ml-auto">
                <a href="{{route('admin.post_comments.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{__('Backend/post_comments.comments')}}</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            {!! Form::model($comment, ['route' => ['admin.post_comments.update', $comment->id], 'method' => 'patch']) !!}
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        {!! Form::label('name', __('Backend/post_comments.name')) !!} {{ $comment->user_id != '' ? '('. __('Backend/post_comments.member') .')' : '' }}
                        {!! Form::text('name', old('name', $comment->name), ['class' => 'form-control']) !!}
                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        {!! Form::label('email', __('Backend/post_comments.email')) !!}
                        {!! Form::email('email', old('email', $comment->email), ['class' => 'form-control' ]) !!}
                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        {!! Form::label('url', __('Backend/post_comments.website')) !!}
                        {!! Form::text('url', old('url', $comment->url), ['class' => 'form-control' ]) !!}
                        @error('url')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    {!! Form::label('ip_address', __('Backend/post_comments.ip')) !!}
                    {!! Form::text('ip_address', old('ip_address', $comment->ip_address), ['class' => 'form-control' ]) !!}
                    @error('ip_address')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="col-6">
                    {!! Form::label('status', __('Backend/post_comments.status')) !!}
                    {!! Form::select('status',['1' => __('Backend/post_comments.active'), '0' => __('Backend/post_comments.inactive') ],  old('status', $comment->status), ['class' => 'form-control']) !!}
                    @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    {!! Form::label('comment', __('Backend/post_comments.comment')) !!}
                    {!! Form::textarea('comment', old('comment', $comment->comment), ['class' => 'form-control', 'rows' => '5' ]) !!}
                    @error('comment')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group pt-4">
                {!! Form::submit(__('Backend/post_comments.update_comment'), ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>


@endsection

