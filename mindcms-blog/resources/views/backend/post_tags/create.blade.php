@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/post_tags.create_tag')}}</h6>
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
            <form method="post" action="{{route('admin.post_tags.store')}}">
                @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="name">{{__('Backend/post_tags.name')}}</label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control">
                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="name_en">{{__('Backend/post_tags.name_en')}}</label>
                        <input type="text" name="name_en" value="{{old('name_en')}}" class="form-control" >
                        @error('name_en')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="form-group pt-4">
                <button type="submit" class="btn btn-primary">{{__('Backend/post_tags.submit')}}</button>
            </div>
            </form>
        </div>
    </div>
@endsection
