@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('backend/vendor/select2/css/select2.min.css') }}"/>
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/announcements.edit_announcement')}} ( {{ config('app.locale') == 'ar' ? $announcement->title : $announcement->title_en }} )</h6>
            <div class="ml-auto">
                <a href="{{route('admin.announcements.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{__('Backend/announcements.announcements')}}</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            {!! Form::model($announcement, ['route' => ['admin.announcements.update', $announcement->id], 'method' => 'patch', 'files' => true]) !!}
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        {!! Form::label('title', __('Backend/announcements.title')) !!}
                        {!! Form::text('title', old('title', config('app.locale') == 'ar' ? $announcement->title : $announcement->title_en), ['class' => 'form-control', 'placeholder' => __('Backend/announcements.ur_title') ]) !!}
                        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        {!! Form::label('description', __('Backend/announcements.description')) !!}
                        {!! Form::textarea('description', old('description', $announcement->description), ['class' => 'form-control summernote', 'placeholder' => __('Backend/announcements.ur_description') ]) !!}
                        @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    {!! Form::label('status', __('Backend/announcements.status')) !!}
                    {!! Form::select('status', ['1' => __('Backend/announcements.active'), '0' => __('Backend/announcements.inactive') ],  old('status', $announcement->status), ['class' => 'form-control']) !!}
                    @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group pt-4">
                {!! Form::submit(__('Backend/announcements.submit'), ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('backend/vendor/select2/js/select2.full.min.js')}}"></script>
    <script>
        $(function() {
            $('.summernote').summernote({
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });



    </script>
@endsection
