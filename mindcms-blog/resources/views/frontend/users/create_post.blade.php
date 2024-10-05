@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{asset('frontend/js/summernote/summernote-bs4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/js/select2/css/select2.min.css') }}"/>
@endsection
@section('content')
    {{--    I am Index Page--}}
    <div class="col-lg-9 col-12">
        <h3>Create Post</h3>
        <form method="post" action="{{route('users.post.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{old('title')}}" class="form-control" placeholder="Your Title">
                @error('title')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="title_en">title_en</label>
                <input type="text" name="title_en" value="{{old('title_en')}}" class="form-control"
                       placeholder="Your title_en">
                @error('title_en')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="description_en">description_en</label>
                <textarea name="description_en" class="form-control summernote"
                          placeholder="Your description_en">{{old('description_en')}}</textarea>
                @error('description_en')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="tags">{{__('Frontend/posts.tags')}}</label>
                <button type="button" class="btn btn-primary btn-xs"
                        id="select_btn_tag">{{__('Frontend/posts.select_all')}}</button>
                <button type="button" class="btn btn-primary btn-xs"
                        id="deselect_btn_tag">{{__('Frontend/posts.deselect_all')}}</button>
                <select name="tags[]" class="form-control selects" multiple="multiple" id="select_all_tags">
                    @foreach($tags as $tag)
                        <option
                            value="{{$tag->id}}" {{ in_array($tag->id, old('tags[]', [])) == $tag->id ? 'selected' : ''   }}>{{$tag->name()}}</option>
                    @endforeach
                </select>
                @error('tags')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="row">
                <div class="col-4">
                    <label for="category_id">category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">---</option>
                        @foreach($categories as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="col-4">
                    {!! Form::label('comment_able', "comment_able") !!}
                    {!! Form::select('comment_able', ['0' => 'No', '1' => 'Yes' ],  old('comment_able'), ['class' => 'form-control' ]) !!}
                    @error('comment_able')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="col-4">
                    {!! Form::label('status', "status") !!}
                    {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive' ],  old('status'), ['class' => 'form-control' ]) !!}
                    @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-12">
                    {!! Form::label('Sliders', "images") !!}
                    <br>
                    <div class="file-loading">
                        {!! Form::file('images[]', ['id' => 'post-images', 'class' => 'file-input-overview', 'multiple' => 'multiple']) !!}
                        <span class="form-text text-muted">Image width should be 800px x 500px</span>
                        @error('images')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="form-group pt-4">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
            </div>


        {!! Form::close() !!}
    </div>
    <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
        @include('partial.frontend.users.sidebar')
    </div>
@endsection
@section('script')
    <script src="{{ asset('frontend/js/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{ asset('frontend/js/select2/js/select2.full.min.js')}}"></script>
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
            $('.selects').select2({
                tags: true,
                minimumResultsForSearch: Infinity,
            });
            $('#select_btn_tag').click(function () {
                $('#select_all_tags > option').prop('selected', 'selected');
                $('#select_all_tags').trigger('change');
            });

            $('#deselect_btn_tag').click(function () {
                $('#select_all_tags > option').prop('selected', '');
                $('#select_all_tags').trigger('change');
            });

            $('#post-images').fileinput({
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
