@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('backend/issues.issues')}}</h6>
            <div class="ml-auto">
                <a href="{{route('admin.issues.create')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        {{__('backend/issues.create_issue')}}
                    </span>
                </a>
            </div>
        </div>
        @include('backend.issues.filter.filter')
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>
                            {{__('backend/issues.volume_number')}}
                        </th>
                        <th>
                            {{__('backend/issues.issue_number')}}
                        </th>
                        <th>
                            {{__('backend/issues.posts_count')}}
                        </th>
                        <th>
                            {{__('backend/issues.created_at')}}
                        </th>
                        <th class="text-center" style="width:30px;" >
                            {{__('backend/issues.actions')}}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($issues as $issue)
                        <tr>
                            <td>{{ $issue->volume->number }}</td>
                            <td>{{ $issue->issue_number }}</td>
                            <td><a href="{{route('admin.posts.index', ['issue_id' =>$issue->id])}}">{{ $issue->posts->count() }}</a></td>
                            <td>{{ $issue->issue_date }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('admin.issues.edit', $issue->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:void(0);" onclick="if(confirm('{{__('backend/issues.are_you_sure')}}')) { document.getElementById('issue-delete-{{$issue->id}}').submit(); } else { return false}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    <form action="{{route('admin.issues.destroy', $issue->id)}}"  method="post" id="issue-delete-{{$issue->id}}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">{{__('backend/issues.no_issue')}}</td>
                        </tr>

                    @endforelse
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="5">
                            <div class="float-right">
                            {!!  $issues->links() !!}
                            </div>
                        </th>
                    </tr>
                    </tfoot>
                </table>
            </div>
    </div>
@endsection
