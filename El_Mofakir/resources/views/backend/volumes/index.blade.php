@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('backend/volumes.volumes')}}</h6>
            <div class="ml-auto">
                <a href="{{route('admin.volumes.create')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        {{__('backend/volumes.create_volume')}}
                    </span>
                </a>
            </div>
        </div>
        @include('backend.volumes.filter.filter')
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>
                            {{__('backend/volumes.volume_number')}}
                        </th>
                        <th>
                            {{__('backend/volumes.issue_count')}}
                        </th>
                        <th>
                            {{__('backend/volumes.posts_count')}}
                        </th>
                        <th>
                            {{__('backend/volumes.status')}}
                        </th>
                        <th>
                            {{__('backend/volumes.created_at')}}
                        </th>
                        <th class="text-center" style="width:30px;" >
                            {{__('backend/volumes.actions')}}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($volumes as $volume)
                        <tr>
                            <td><a href="{{route('admin.volumes.show', $volume->id)}}">{{ $volume->number }}</a></td>
                            <td><a href="{{route('admin.issues.index', ['volume_id' =>$volume->id])}}">{{ $volume->issues_count }}</a></td>
                            <td>
                                <a href="{{ route('admin.posts.index', ['volume_id' => $volume->id]) }}">
                                    {{ $volume->posts_count }}
                                </a>
                            </td>
                            <td>{{ $volume->status() }}</td>
                            <td>{{ $volume->year }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('admin.volumes.edit', $volume->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:void(0);" onclick="if(confirm('{{__('backend/volumes.are_you_sure')}}')) { document.getElementById('volume-delete-{{$volume->id}}').submit(); } else { return false}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    <form action="{{route('admin.volumes.destroy', $volume->id)}}"  method="post" id="volume-delete-{{$volume->id}}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">{{__('backend/volumes.no_volume')}}</td>
                        </tr>

                    @endforelse
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="5">
                            <div class="float-right">
                            {!!  $volumes->links() !!}
                            </div>
                        </th>
                    </tr>
                    </tfoot>
                </table>
            </div>
    </div>
@endsection
