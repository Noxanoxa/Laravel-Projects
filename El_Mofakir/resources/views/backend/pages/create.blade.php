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
                                      class="form-control">{{old('description')}}</textarea>
                            @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="description_en">{{__('backend/pages.description_en')}}</label>
                            <textarea name="description_en"
                                      class="form-control">{{old('description_en')}}</textarea>
                            @error('description_en')<span class="text-danger">{{ $message }}</span>@enderror
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
