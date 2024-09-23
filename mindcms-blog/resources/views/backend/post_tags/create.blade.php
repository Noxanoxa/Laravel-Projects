@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/post_tags.create_tag')}}</h6>
            <div class="ml-auto">
                <a href="{{route('admin.post_tags.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{__('Backend/post_tags.tags')}}</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'admin.post_tags.store', 'method' => 'post']) !!}
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        {!! Form::label('name', __('Backend/post_tags.name')) !!}
                        {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => __('Backend/post_tags.ur_name')]) !!}
                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="form-group pt-4">
                {!! Form::submit(__('Backend/post_tags.submit'), ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
