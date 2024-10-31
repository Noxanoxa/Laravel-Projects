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
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $page->title) }}">
                        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="title_en">{{__('backend/pages.title_en')}}</label>
                        <input type="text" name="title_en" id="title_en" class="form-control" value="{{ old('title_en', $page->title_en) }}" >
                        @error('title_en')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
                <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="description">{{__('backend/pages.description')}}</label>
                        <textarea name="description" id="description" class="form-control">{{ old('description', $page->description) }}</textarea>
                        @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="description_en">{{__('backend/pages.description_en')}}</label>
                        <textarea name="description_en" id="description_en" class="form-control" placeholder="{{__('backend/pages.ur_description_en')}}">{{ old('description_en', $page->description_en) }}</textarea>
                        @error('description_en')<span class="text-danger">{{ $message }}</span>@enderror
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

