@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                {{__('backend/pages.pages')}}
            </h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>
                        {{__('backend/pages.title')}}
                    </th>
                    <th>
                        {{__('backend/pages.status')}}
                    </th>
                    <th>
                        {{__('backend/pages.user')}}
                    </th>
                    <th>
                        {{__('backend/pages.created_at')}}
                    </th>
                    <th class="text-center" style="width:30px;">
                        {{__('backend/pages.actions')}}
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($pages as $page)
                    <tr>
                        <td><a href="{{route('admin.pages.show', $page->id)}}">{{$page->title()}}</a></td>
                        <td>{{ $page->status()}}</td>
                        <td>{{ $page->user->name}}</td>
                        <td>{{ config('app.locale') == 'en' ? $page->created_at ->format('d-m-Y h:i a') :   $page->created_at->locale('ar')->translatedFormat('d-m-Y h:i a') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{route('admin.pages.edit', $page->id)}}" class="btn btn-primary"><i
                                        class="fa fa-edit"></i></a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            {{__('backend/pages.no_page')}}
                        </td>
                    </tr>

                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="6">
                        <div class="float-right">
                            {!!  $pages->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection
