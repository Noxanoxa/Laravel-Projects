@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                {{__('Backend/contact_us.contact')}}
            </h6>
        </div>

        @include('backend.contact_us.filter.filter')

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>{{__('Backend/contact_us.from')}}</th>
                    <th>{{__('Backend/contact_us.title')}}</th>
                    <th>{{__('Backend/contact_us.status')}}</th>
                    <th>{{__('Backend/contact_us.created_at')}}</th>
                    <th class="text-center" style="width: 30px;">{{__('Backend/contact_us.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($messages as $message)
                    <tr>
                        <td><a href="{{ route('admin.contact_us.show', $message->id) }}">{{ $message->name }}</a></td>
                        <td>{{ $message->title }}</td>
                        <td>{{ $message->status() }}</td>
                        <td>{{ config('app.locale') == 'en' ? $message->created_at ->format('d-m-Y h:i a') :   $message->created_at->locale('ar')->translatedFormat('d-m-Y h:i a') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.contact_us.show', $message->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                <a href="javascript:void(0)" onclick="if (confirm(
                                    '{{__('Backend/contact_us.are_you_sure')}}'
                                ) ) { document.getElementById('message-delete-{{ $message->id }}').submit(); } else { return false; }" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                <form action="{{ route('admin.contact_us.destroy', $message->id) }}" method="post" id="message-delete-{{ $message->id }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            {{__('Backend/contact_us.no_messages')}}
                        </td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="5">
                        <div class="float-right">
                            {!! $messages->appends(request()->input())->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
