@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('backend/pages.page')}} {{ $page->tilte }}</h6>
            <div class="ml-auto">
                <a href="{{route('admin.posts.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{__('backend/pages.pages')}}</span>
                </a>
            </div>
        </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td colspan="4"><a href="{{route('admin.posts.show', $page->id)}}">{{ $page->title() }}</a></td>
                        </tr>
                        <tr>
                            <th>{{__('backend/pages.description_en')}}</th>
                            <td>{{ $page->description_en }}</td>
                        </tr>
                    <tr>
                        <th>{{__('backend/pages.description')}}</th>
                        <td>{{ $page->description }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
    </div>
@endsection
