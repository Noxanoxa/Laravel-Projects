@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">User {{ $user->name }}</h6>
            <div class="ml-auto">
                <a href="{{route('admin.users.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Users</span>
                </a>
            </div>
        </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td colspan="4">
                                @if($user->user_image != '')
                                    <img src="{{asset('assets/users/' . $user->user_image)}}" class="img-fluid">
                                @else
                                    <img src="{{asset('assets/users/default.png')}}" class="img-fluid">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $user->name}} ({{ $user->username }})</td>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td>{{ $user->mobile}}</td>
                            <th>Status</th>
                            <td>{{ $user->status()}}</td>
                        </tr>
                        <tr>
                            <th>Created Date</th>
                            <td>{{ $user->created_at ->format('d-m-Y h:i a')}}</td>
                            <th>Posts Count</th>
                            <td>{{ $user->posts_count }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>

{{--    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Comments</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Author</th>
                    <th width="40%">Comment</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th class="text-center" style="width:30px;" >Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($user->comments as $comment)
                    <tr>
                        <td><img src="{{ get_gravatar($comment->email, 50)  }}" class="img-circle"></td>
                        <td>{{ $comment->name }}</td>
                        <td>{!! $comment->comment !!}</td>
                        <td>{{ $comment->status() }}</td>
                        <td>{{ $comment->created_at ->format('d-m-Y h:i a')}}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{route('admin.post_comments.edit', $comment->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0);" onclick="if(confirm('Are you sure to delete this comment? ')) { document.getElementById('comment-delete-{{$comment->id}}').submit(); } else { return false}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                <form action="{{route('admin.post_comments.destroy', $comment->id)}}"  method="post" id="comment-delete-{{$comment->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No comments found</td>
                    </tr>

                @endforelse
                </tbody>
            </table>
        </div>
    </div>--}}

@endsection
