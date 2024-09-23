@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/post_categories.create_category')}}</h6>
            <div class="ml-auto">
                <a href="{{route('admin.post_categories.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{__('Backend/post_categories.categories')}}</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'admin.post_categories.store', 'method' => 'post']) !!}
            <div class="row">
                <div class="col-8">
                    <div class="form-group">
                        {!! Form::label('name', __('Backend/post_categories.name')) !!}
                        {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => __('Backend/post_categories.ur_name')]) !!}
                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-4">
                    {!! Form::label('status', __('Backend/post_categories.status')) !!}
                    {!! Form::select('status', ['1' => __('Backend/post_categories.active'), '0' => __('Backend/post_categories.inactive') ],  old('status'), ['class' => 'form-control']) !!}
                    @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group pt-4">
                {!! Form::submit(__('Backend/post_categories.submit'), ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
