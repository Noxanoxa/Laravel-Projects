@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/professionals.professionals')}}</h6>
            <div class="ml-auto">
                <a href="{{route('admin.professionals.create')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">{{__('Backend/professionals.add_professional')}}</span>
                </a>
            </div>
        </div>
        @include('backend.professionals.filter.filter')
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>{{__('Backend/professionals.professional_image')}}</th>
                    <th>{{__('Backend/professionals.name')}}</th>
                    <th>{{__('Backend/professionals.email')}} & {{__('Backend/professionals.mobile')}}</th>
                    <th>{{__('Backend/professionals.status')}}</th>
                    <th>{{__('Backend/professionals.created_at')}}</th>
                    <th class="text-center" style="width:30px;">{{__('Backend/professionals.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>
                            @if($user->user_image != '')
                                <img src="{{asset('assets/users/' . $user->user_image)}}" width="60">
                            @else
                                <img src="{{asset('assets/users/default.png')}}" width="60">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.professionals.show', $user->id) }}">{{ $user->name }}</a>
                            <p class="text-gray-400"><b>{{ $user->username }}</b></p>
                        </td>
                        <td>
                            {{ $user->email }}
                            <p class="text-gray-400"><b>{{ $user->mobile }}</b></p>
                        </td>
                        <td>{{ $user->status() }}</td>
                        <td>{{ $user->created_at ->format('d-m-Y h:i a')}}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{route('admin.professionals.edit', $user->id)}}" class="btn btn-primary"><i
                                        class="fa fa-edit"></i></a>
                                <a href="javascript:void(0);"
                                   onclick="if(confirm('{{ __('Backend/professionals.are_you_sure') }}')) { document.getElementById('user-delete-{{$user->id}}').submit(); } else { return false}"
                                   class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                <form action="{{route('admin.professionals.destroy', $user->id)}}" method="post"
                                      id="user-delete-{{$user->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">{{__('Backend/professionals.no_users')}}</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="6">
                        <div class="float-right">
                            {!!  $users->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
