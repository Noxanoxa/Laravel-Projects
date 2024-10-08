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
                    <div class="col-6">
                        <div class="form-group">
                            <label for="title">{{__('backend/pages.title')}}</label>
                            <input type="text" name="title" class="form-control" value="{{old('title')}}">
                            @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="title_en">{{__('backend/pages.title_en')}}</label>
                            <input type="text" name="title_en" class="form-control" value="{{old('title_en')}}">
                            @error('title_en')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="description">{{__('backend/pages.description')}}</label>
                            <textarea name="description"
                                      class="form-control summernote">{{old('description')}}</textarea>
                            @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="description_en">{{__('backend/pages.description_en')}}</label>
                            <textarea name="description_en"
                                      class="form-control summernote">{{old('description_en')}}</textarea>
                            @error('description_en')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-6">
                        <label for="category_id">{{__('backend/pages.category')}}</label>
                        <select name="category_id" class="form-control">
                            <option value="">---</option>
                            @foreach($categories as  $category)
                                <option
                                    value="{{ $category->id }}" {{in_array($category->id, old('categories', [])) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name() }}
                                </option>
                            @endforeach
                        </select>
                            @error('category_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-6">
                        <label for="status">{{__('Backend/pages.status')}}</label>
                        <select name="status" class="form-control">
                            <option value="">---</option>
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>{{__('Backend/pages.active')}}</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>{{__('Backend/pages.inactive')}}</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                </div>
                <div class="row pt-4">
                    <div class="col-12">
                        <label for="images">{{__('backend/pages.sliders')}}</label>
                        <br>
                        <div class="file-loading">
                            <input id="page-images" type="file" name="images[]" class="file-input-overview"
                                   multiple="multiple">
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
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('frontend/js/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $(function () {
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
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
            });
            $('#page-images').fileinput({
                theme: 'fas',
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
