@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('backend/vendor/select2/css/select2.min.css') }}"/>
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/posts.edit_post')}}
                ( {{ $post->title() }} )</h6>
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
                            <input type="text" name="title" value="{{old('title', $post->title)}}" class="form-control"
                                   placeholder="{{__('Backend/posts.ur_title')}}">
                            @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="title_en">{{__('Backend/posts.title_en')}}</label>
                            <input type="text" name="title_en" value="{{old('title_en', $post->title_en)}}"
                                   class="form-control" placeholder="{{__('Backend/posts.ur_title_en')}}">
                            @error('title_en')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="description">{{__('Backend/posts.description')}}</label>
                            <textarea name="description" class="form-control"
                                      placeholder="{{__('Backend/posts.ur_description')}}">{!! old('description', $post->description) !!}</textarea>
                            @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="description_en">{{__('Backend/posts.description_en')}}</label>
                            <textarea name="description_en" class="form-control"
                                      placeholder="{{__('Backend/posts.ur_description_en')}}">{!! old('description_en' , $post->description_en) !!}</textarea>
                            @error('description_en')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="tags">{{__('Backend/posts.tags')}}</label>
                            <button type="button" class="btn btn-primary btn-sm"
                                    id="select_btn_tag">{{__('Backend/posts.select_all')}}</button>
                            <button type="button" class="btn btn-primary btn-sm"
                                    id="deselect_btn_tag">{{__('Backend/posts.deselect_all')}}</button>

                            <select name="tags[]" class="form-control selects" multiple="multiple" id="select_all_tags">
                                @foreach($tags as $tag)
                                    <option
                                        value="{{$tag->id}}" {{ in_array($tag->id, old('tags[]', $post->tags->pluck('id')->toArray() )) ? 'selected' : ''   }}>{{$tag->name()}}</option>
                                @endforeach
                            </select>
                            @error('tags[]')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="category_id">{{__('Backend/posts.category')}}</label>
                        <select name="category_id" class="form-control">
                            <option value="">---</option>
                            @foreach($categories as $category)
                                <option
                                    value="{{$category->id}}" {{  old('category_id', $post->category_id ) == $category->id ? 'selected' : '' }} >{{$category->name()}}</option>
                            @endforeach
                        </select>
                        @error('category_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-4">
                        <label for="status">{{__('Backend/posts.status')}}</label>
                        <select name="status" class="form-control">
                            <option
                                value="1" {{ old('status', $post->status) == '1' ? 'selected' : '' }}>{{__('Backend/posts.active')}}</option>
                            <option
                                value="0" {{ old('status', $post->status) == '0' ? 'selected' : '' }}>{{__('Backend/posts.inactive')}}</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-12">
                        <label for="pdf">{{__('Backend/posts.sliders')}}</label>
                        <br>
                        <div class="file-loading">
                            <input type="file" name="pdf[]" id="post-pdf" class="file-input-overview"
                                   multiple="multiple">
                            <span class="form-text text-muted">{{__('Backend/posts.pdf_note')}}</span>
                            @error('pdf[]')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group pt-4">
                    <button type="submit" class="btn btn-primary">{{__('Backend/posts.update_post')}}</button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('backend/vendor/select2/js/select2.full.min.js')}}"></script>
    <script>
        $(function () {
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
            @if(optional($post->media->count() > 0))
            $('#post-pdf').fileinput({
                theme: 'fas',
                maxFileCount: {{5 - $post->media->count()}},
                allowedFileTypes: ['pdf'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview: [
                        @foreach($post->media as $media)
                        "{{ asset('assets/posts/' . $media->file_name) }}",
                    @endforeach
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'pdf',
                initialPreviewConfig: [
                        @foreach($post->media as $media)
                    {
                        caption: "{{ $media->real_file_name }}",
                        size: {{ $media->file_size }},
                        key: {{ $media->id }},
                        url: "{{ route('admin.posts.media.destroy', [$media->id, '_token' => csrf_token()]) }}",
                    },
                    @endforeach
                ],
            });
            @else
            $('#post-pdf').fileinput({
                theme: 'fas',
                maxFileCount: {{5 - $post->media->count()}},
                allowedFileTypes: ['pdf'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
            });
            @endif
        });
    </script>
@endsection
