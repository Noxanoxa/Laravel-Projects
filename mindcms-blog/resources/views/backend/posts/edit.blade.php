@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('backend/vendor/select2/css/select2.min.css') }}"/>
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/posts.edit_post')}} ( {{ config('app.locale') == 'ar' ? $post->title : $post->title_en }} )</h6>
            <div class="ml-auto">
                <a href="{{route('admin.posts.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{__('Backend/posts.posts')}}</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('admin.posts.update', $post->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="title">{{__('Backend/posts.title')}}</label>
                            <input type="text" name="title" value="{{old('title', $post->title)}}" class="form-control" placeholder="{{__('Backend/posts.ur_title')}}">
                            @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="title_en">{{__('Backend/posts.title_en')}}</label>
                            <input type="text" name="title_en" value="{{old('title_en', $post->title_en)}}" class="form-control" placeholder="{{__('Backend/posts.ur_title_en')}}">
                            @error('title_en')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="description">{{__('Backend/posts.description')}}</label>
                            <textarea name="description" class="form-control summernote" placeholder="{{__('Backend/posts.ur_description')}}">{!! old('description', $post->description) !!}</textarea>
                            @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="description_en">{{__('Backend/posts.description_en')}}</label>
                            <textarea name="description_en" class="form-control summernote" placeholder="{{__('Backend/posts.ur_description_en')}}">{!! old('description_en' , $post->description_en) !!}</textarea>
                            @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="tags">{{__('Backend/posts.tags')}}</label>
                            <button type="button" class="btn btn-primary btn-xs" id="select_btn_tag">{{__('Backend/posts.select_all')}}</button>
                            <button type="button" class="btn btn-primary btn-xs" id="deselect_btn_tag">{{__('Backend/posts.deselect_all')}}</button>
                            <select name="tags[]" class="form-control selects" multiple="multiple" id="select_all_tags">
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}" {{ in_array($tag->id, old('tags', )) == $tag->id ? 'selected' : ''   }}>{{$tag->name()}}</option>
                                @endforeach
                            </select>
                            @error('tags')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="col-4">
                    {!! Form::label('category_id', __('Backend/posts.category')) !!}
                    {!! Form::select('category', ['' => '---' ] + $categories->toArray() ,  old('category_id', $post->category_id), ['class' => 'form-control' ]) !!}
                    @error('category_id')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="col-4">
                    {!! Form::label('comment_able', "comment_able") !!}
                    {!! Form::select('comment_able', ['0' => __('Backend/posts.no'), '1' => __('Backend/posts.yes') ],  old('comment_able', $post->comment_able), ['class' => 'form-control' ]) !!}
                    @error('comment_able')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="col-4">
                    {!! Form::label('status', __('Backend/posts.status')) !!}
                    {!! Form::select('status', ['1' => __('Backend/posts.active'), '0' => __('Backend/posts.inactive') ],  old('status', $post->status), ['class' => 'form-control']) !!}
                    @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-12">
                    <div class="file-loading">
                        {!! Form::file('images[]', ['id' => 'post-images', 'multiple' => 'multiple']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group pt-4">
                {!! Form::submit(__('Backend/posts.submit'), ['class' => 'btn btn-primary']) !!}
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
            $('.selects').select2({
                tags: true,
                minimumResultsForSearch: Infinity,
            });
            $('#select_btn_tag').click(function(){
                $('#select_all_tags > option').prop('selected', 'selected');
                $('#select_all_tags').trigger('change');
            });

            $('#deselect_btn_tag').click(function(){
                $('#select_all_tags > option').prop('selected', '');
                $('#select_all_tags').trigger('change');
            });
            $('#post-images').fileinput({
                theme: "fas",
                maxFileCount:  {{5 - $post->media->count()}},
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview: [
                    @if($post->media->count() > 0)
                        @foreach($post->media as $media)
                        "{{ asset('assets/posts/' . $media->file_name) }}",
                    @endforeach
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                        @if($post->media->count() > 0)
                        @foreach($post->media as $media)
                    {caption: "{{ $media->file_name }}", size: {{ $media->file_size }}, width: "120px", url: "{{ route('admin.posts.media.destroy', [$media->id, '_token' => csrf_token()]) }}", key: "{{ $media->id }}"},
                    @endforeach
                    @endif
                ],
            });
        });



    </script>
@endsection
