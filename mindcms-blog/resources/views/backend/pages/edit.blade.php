@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                {{__('Backend/pages.edit_page')}} ( {{ $page->title }})</h6>
            <div class="ml-auto">
                <a href="{{route('admin.pages.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{__('Backend/pages.pages')}}</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="title">{{__('backend/pages.title')}}</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $page->title) }}" placeholder="{{__('backend/pages.ur_title')}}">
                        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="title_en">{{__('backend/pages.title_en')}}</label>
                        <input type="text" name="title_en" id="title_en" class="form-control" value="{{ old('title_en', $page->title_en) }}" placeholder="{{__('backend/pages.ur_title_en')}}">
                        @error('title_en')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
                <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="description">{{__('backend/pages.description')}}</label>
                        <textarea name="description" id="description" class="form-control summernote" placeholder="{{__('backend/pages.ur_description')}}">{{ old('description', $page->description) }}</textarea>
                        @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="description_en">{{__('backend/pages.description_en')}}</label>
                        <textarea name="description_en" id="description_en" class="form-control summernote" placeholder="{{__('backend/pages.ur_description_en')}}">{{ old('description_en', $page->description_en) }}</textarea>
                        @error('description_en')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
                <div class="row">
                <div class="col-6">
                    <label for="category_id">{{__('backend/pages.category')}}</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">{{__('backend/pages.select_category')}}</option>
                        @foreach($categories as $key => $value)
                            <option value="{{ $key }}" {{ $key == $page->category_id ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="col-6">
                    <label for="status">{{__('backend/pages.status')}}</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" {{ $page->status == 1 ? 'selected' : '' }}>{{__('backend/pages.active')}}</option>
                        <option value="0" {{ $page->status == 0 ? 'selected' : '' }}>{{__('backend/pages.inactive')}}</option>
                    </select>
                    @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-12">
                    <div class="file-loading">
                        <input type="file" name="images[]" id="page-images" multiple>
                    </div>
                </div>
            </div>
            <div class="form-group pt-4">
                <button type="submit" class="btn btn-primary">{{__('backend/pages.update_page')}}</button>
            </div>
            </form>
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
                maxFileCount:  {{5 - $page->media->count()}},
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview: [
                    @if($page->media->count() > 0)
                        @foreach($page->media as $media)
                        "{{ asset('assets/posts/' . $media->file_name) }}",
                    @endforeach
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                        @if($page->media->count() > 0)
                        @foreach($page->media as $media)
                    {caption: "{{ $media->file_name }}", size: {{ $media->file_size }}, width: "120px", url: "{{ route('admin.pages.media.destroy', [$media->id, '_token' => csrf_token()]) }}", key: "{{ $media->id }}"},
                    @endforeach
                    @endif
                ],
            });
        });



    </script>
@endsection
