@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('backend/vendor/select2/css/select2.min.css') }}"/>
@endsection
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/announcements.create_announcement')}}</h6>
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
            <form method="post" action="{{route('admin.announcements.store')}}" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="title">{{__('Backend/announcements.title')}}</label>
                        <input type="text" name="title" value="{{old('title')}}" class="form-control" placeholder="{{__('Backend/announcements.ur_title')}}">
                        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="title_en">{{__('Backend/announcements.title_en')}}</label>
                        <input type="text" name="title_en" value="{{old('title_en')}}" class="form-control" placeholder="{{__('Backend/announcements.ur_title_en')}}">
                        @error('title_en')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="description_en">{{__('Backend/announcements.description_en')}}</label>
                    <textarea name="description_en" class="form-control summernote" placeholder="{{__('Backend/announcements.ur_description_en')}}">{!! old('description_en') !!}</textarea>
                        @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <label for="status">{{__('Backend/announcements.status')}}</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>{{__('Backend/announcements.active')}}</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>{{__('Backend/announcements.inactive')}}</option>
                    </select>
                    @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group pt-4">
                <button type="submit" class="btn btn-primary">{{__('Backend/announcements.submit')}}</button>
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
