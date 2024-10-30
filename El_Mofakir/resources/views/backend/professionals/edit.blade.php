@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/professionals.edit_professional')}}({{ $user->name }})</h6>
            <div class="ml-auto">
                <a href="{{route('admin.professionals.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{__('Backend/professionals.professionals')}}</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('admin.professionals.update', $user->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="name">{{__('Backend/professionals.name')}}</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="username">{{__('Backend/professionals.username')}}</label>
                            <input type="text" name="username" value="{{ old('username', $user->username) }}"
                                   class="form-control">
                            @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="email">{{__('Backend/professionals.email')}}</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                   class="form-control">
                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="mobile">{{__('Backend/professionals.mobile')}}</label>
                            <input type="text" name="mobile" value="{{ old('mobile', $user->mobile) }}"
                                   class="form-control">
                            @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-12">
                        <label for="pdf">{{__('Backend/professionals.cv')}}</label>
                        <br>
                        <div class="file-loading">
                            <input type="file" name="pdf" id="cv-pdf" class="file-input-overview"
                                   multiple="multiple">
                            <span class="form-text text-muted">{{__('Backend/professionals.pdf_note')}}</span>
                            @error('pdf')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row pt-4">
                    @if($user->user_image != '')
                        <div class="col-12 text-center">
                            <div class="imgArea">
                                <img src="{{ asset('assets/users/' . $user->user_image) }}" width="300" height="300"
                                     class="img-thumbnail">
                                <button type="button"
                                        class="btn btn-danger remove-image">{{__('Backend/professionals.remove_image')}}</button>
                            </div>
                        </div>
                    @endif
                    <div class="col-12">
                        <label for="user_image">{{__('Backend/professionals.professional_image')}}</label>
                        <br>
                        <div class="file-loading">
                            <input id="user-image" type="file" name="user_image" class="file-input-overview">
                            <span class="form-text text-muted">{{__('Backend/professionals.image_note')}}</span>
                            @error('images')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group pt-4">
                    <button type="submit" class="btn btn-primary">{{__('Backend/professionals.update')}}</button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(function () {
            $('#user-image').fileinput({
                theme: 'fas',
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
            });
            $('.remove-image').click(function () {
                $.post('{{ route('admin.professionals.remove_image') }}', { user_id: '{{ $user->id }}', _token: '{{ csrf_token() }}' }, function (data) {
                    if (data == 'true') {
                        window.location.href = window.location;
                    }
                });
            });
            @if(optional($user->media)->count() > 0)
            $('#cv-pdf').fileinput({
                theme: 'fas',
                maxFileCount: 1,
                allowedFileTypes: ['pdf'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview: [
                        "{{ asset('assets/users/' . $user->media->file_name) }}",
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'pdf',
                initialPreviewConfig: [
                    {
                        caption: "{{ $user->media->real_file_name }}",
                        size: {{ $user->media->file_size }},
                        key: {{ $user->media->id }},
                        url: "{{ route('admin.professionals.media.destroy', [$user->media->id, '_token' => csrf_token()]) }}",
                    },

                ],
            });
            @else
            $('#cv-pdf').fileinput({
                theme: 'fas',
                maxFileCount: 1,
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
