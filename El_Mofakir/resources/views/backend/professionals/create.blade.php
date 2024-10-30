@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/professionals.create')}}</h6>
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
            <form method="post" action="{{route('admin.professionals.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="name">{{__('Backend/professionals.name')}}</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                        <label for="username">{{__('Backend/professionals.username')}}</label>
                        <input type="text" name="username" value="{{ old('username') }}" class="form-control">
                        @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="email">{{__('Backend/professionals.email')}}</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                </div>

                    <div class="row">
                        <div class="col-3">
                            <label for="status">{{__('Backend/professionals.international')}}</label>
                            <select name="status" class="form-control">
                                <option value="">---</option>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>{{__('Backend/professionals.yes')}}</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>{{__('Backend/professionals.no')}}</option>
                            </select>
                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="mobile">{{__('Backend/professionals.mobile')}}</label>
                                <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control">
                                @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                <div class="row pt-4">
                    <div class="col-12">
                        <label for="pdf">{{__('Backend/professionals.cv')}}</label>
                        <br>
                        <div class="file-loading">
                            <input type="file" name="pdf" id="cv-pdf" class="file-input-overview">
                            <span class="form-text text-muted">{{__('Backend/professionals.pdf_note')}}</span>
                            @error('pdf')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row pt-4">
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
                    <button type="submit" class="btn btn-primary">{{__('Backend/professionals.submit')}}</button>
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
            $('#cv-pdf').fileinput({
                theme: "fas",
                maxFileCount: 1,
                allowedFileTypes: ['pdf'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
            });
        });
    </script>
@endsection
