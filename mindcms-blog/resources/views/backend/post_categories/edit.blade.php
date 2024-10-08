@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/post_categories.edit_category')}}
                ( {{ config('app.locale') == 'ar' ? $category->name : $category->name_en  }} )</h6>
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
            <form method="POST" action="{{ route('admin.post_categories.update', $category->id) }}">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="name">{{__('Backend/post_categories.name')}}</label>
                            <input type="text" name="name" value="{{ old('name',  $category->name) }}"
                                   class="form-control" placeholder="{{__('Backend/post_categories.ur_name')}}">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="name_en">{{__('Backend/post_categories.name_en')}}</label>
                            <input type="text" name="name_en" value="{{ old('name_en',  $category->name_en) }}"
                                   class="form-control" placeholder="{{__('Backend/post_categories.ur_name_en')}}">
                            @error('name_en')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="status">{{__('Backend/post_categories.status')}}</label>
                        <select name="status" class="form-control">
                            <option
                                value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>{{__('Backend/post_categories.active')}}</option>
                            <option
                                value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>{{__('Backend/post_categories.inactive')}}</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit"
                            class="btn btn-primary">{{__('Backend/post_categories.update_category')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
