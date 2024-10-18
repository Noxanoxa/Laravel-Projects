@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/volumes.edit_volume')}} {{ config('app.locale') =='en' ? $volume->number : $volume->number }}</h6>
            <div class="ml-auto">
                <a href="{{route('admin.volumes.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{__('Backend/volumes.volumes')}}</span>
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <td colspan="4"><a href="{{route('admin.volumes.show', $volume->id)}}">{{  $volume->number }}</a></td>
                </tr>
                <tr>
                    <th>{{__('Backend/volumes.issues')}}</th>
                    <td>{{ $volume->issues->count() }}</td>
                    <th>{{__('Backend/volumes.status')}}</th>
                    <td>{{ $volume->status() }}</td>
                </tr>
                <tr>
                    <th>{{__('Backend/volumes.year')}}</th>
                    <td>{{ $volume->year }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/volumes.issues')}}</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>{{__('Backend/volumes.number')}}</th>
                    <th>{{__('Backend/volumes.date')}}</th>
                    <th class="text-center" style="width:30px;">{{__('Backend/volumes.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($volume->issues as $issue)
                    <tr>
                        <td>{{ $issue->number }}</td>
                        <td>{{ $issue->date }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{route('admin.issues.edit', $issue->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0);" onclick="if(confirm('{{__('Backend/issues.are_you_sure')}}')) { document.getElementById('issue-delete-{{$issue->id}}').submit(); } else { return false}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                <form action="{{route('admin.issues.destroy', $issue->id)}}" method="post" id="issue-delete-{{$issue->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">{{__('Backend/volumes.no_issues')}}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
