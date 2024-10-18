@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/post_tags.edit_tag')}}( {{ config('app.locale') == 'ar' ? $tag->name : $tag->name_en }})</h6>
            <div class="ml-auto">
                <a href="{{route('admin.post_tags.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{__('Backend/post_tags.tags')}}</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('admin.post_tags.update', $tag->id)}}" method="post">
                @csrf
                @method('patch')
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="name">{{__('Backend/post_tags.name')}}</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $tag->name) }}">
                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="name_en">{{__('Backend/post_tags.name_en')}}</label>
                        <input type="text" name="name_en" id="name_en" class="form-control" value="{{ old('name_en', $tag->name_en) }}">
                        @error('name_en')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="form-group pt-4">
                <button type="submit" class="btn btn-primary">{{__('Backend/post_tags.update_tag')}}</button>
            </div>
            </form>
        </div>
    </div>
@endsection
