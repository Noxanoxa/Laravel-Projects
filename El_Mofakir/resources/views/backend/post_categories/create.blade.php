@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/post_categories.create_category')}}</h6>
            <div class="ml-auto">
                <a href="{{route('admin.post_categories.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{__('Backend/post_categories.categories')}}</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('admin.post_categories.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="name">{{__('Backend/post_categories.name')}}</label>
                            <input type="text" name="name" class="form-control" value="{{old('name')}}">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="name_en">{{__('Backend/post_categories.name_en')}}</label>
                            <input type="text" name="name_en" class="form-control" value="{{old('name_en')}}">
                            @error('name_en')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="status">{{__('Backend/post_categories.status')}}</label>
                        <select name="status" class="form-control">
                            <option
                                value="1" {{old('status') == '1' ? 'selected' : ''}}>{{__('Backend/post_categories.active')}}</option>
                            <option
                                value="0" {{old('status') == '0' ? 'selected' : ''}}>{{__('Backend/post_categories.inactive')}}</option>
                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-group pt-4">
                    <button type="submit" class="btn btn-primary">{{__('Backend/post_categories.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
