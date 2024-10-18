@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/post_tags.tags')}}</h6>
            <div class="ml-auto">
                <a href="{{route('admin.post_tags.create')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">{{__('Backend/post_tags.add_tag')}}</span>
                </a>
            </div>
        </div>
        @include('backend.post_tags.filter.filter')
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>{{__('Backend/post_tags.name')}}</th>
                    <th>{{__('Backend/post_tags.posts_count')}}</th>
                    <th>{{__('Backend/post_tags.created_at')}}</th>
                    <th class="text-center" style="width:30px;">{{__('Backend/post_tags.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($tags as $tag)
                    <tr>
                        <td>{{  $tag->name()}}</td>
                        <td><a href="{{route('admin.posts.index', ['tag_id' =>$tag->id])}}">{{ $tag->posts_count }}</a>
                        </td>
                        <td>{{ config('app.locale') == 'en' ? $tag->created_at ->format('d-m-Y h:i a') :   $tag->created_at->locale('ar')->translatedFormat('d-m-Y h:i a') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{route('admin.post_tags.edit', $tag->id)}}" class="btn btn-primary"><i
                                        class="fa fa-edit"></i></a>
                                <a href="javascript:void(0);"
                                   onclick="if(confirm('{{__('Backend/post_tags.are_you_sure')}} ')) { document.getElementById('tag-delete-{{$tag->id}}').submit(); } else { return false}"
                                   class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                <form action="{{route('admin.post_tags.destroy', $tag->id)}}" method="post"
                                      id="tag-delete-{{$tag->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">{{__('Backend/post_tags.no_tags')}}</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="5">
                        <div class="float-right">
                            {!!  $tags->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
