@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                {{__('backend/pages.create_page')}}
            </h6>
            <div class="ml-auto">
                <a href="{{route('admin.pages.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">
                        {{__('backend/pages.pages')}}
                    </span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('admin.pages.store')}}" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="title">{{__('backend/pages.title')}}</label>
                        <input type="text" name="title" class="form-control" placeholder="{{__('backend/pages.ur_title')}}" value="{{old('title')}}">
                        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="description">{{__('backend/pages.description')}}</label>
                        <textarea name="description" class="form-control summernote" placeholder="{{__('backend/pages.ur_description')}}">{{old('description')}}</textarea>
                        @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="category_id">{{__('backend/pages.category')}}</label>
                    <select name="category_id" class="form-control">
                        <option value="">---</option>
                        @foreach($categories as $key => $category)
                            <option value="{{ $key }}"> {{ $category }} </option>
                        @endforeach
                    @error('category_id')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="col-6">
                    <label for="status">{{__('backend/pages.status')}}</label>
                    <select name="status" class="form-control">
                        <option value="1"> {{__('backend/pages.active')}} </option>
                        <option value="0"> {{__('backend/pages.inactive')}} </option>
                    @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-12">
                    <label for="images">{{__('backend/pages.images')}}</label>
                    <br>
                    <div class="file-loading">
                        <input id="page-images" type="file" name="images[]" class="file" data-overwrite-initial="false" data-min-file-count="2">
                        <span class="form-text text-muted">
                            {{__('backend/pages.images_note')}}
                        </span>
                        @error('images')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="form-group pt-4">
                <button type="submit" class="btn btn-primary">{{__('backend/pages.submit')}}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>


@endsection
@section('script')
    <script src="{{ asset('frontend/js/summernote/summernote-bs4.min.js')}}"></script>
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
            $('#page-images').fileinput({
                theme: "fas",
                maxFileCount: 5,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
            });
        });
    </script>
@endsection
