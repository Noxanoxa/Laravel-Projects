@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/posts.edit_post')}} {{ config('app.locale') =='en' ? $post->title_en : $post->title }}</h6>
            <div class="ml-auto">
                <a href="{{route('admin.posts.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{__('Backend/posts.posts')}}</span>
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <td colspan="4"><a href="{{route('admin.posts.show', $post->id)}}">{{  $post->title() }}</a></td>
                </tr>
                <tr>
                    <th>{{__('Backend/posts.status')}}</th>
                    <td>{{ $post->status() }}</td>
                    <th>{{__('Backend/posts.created_at')}}</th>
                    <td>{{ config('app.locale') == 'en' ? $post->created_at ->format('d-m-Y h:i a') :   $post->created_at->locale('ar')->translatedFormat('d-m-Y h:i a') }}</td>
                </tr>
                <tr>
                    <th>{{__('Backend/posts.category')}}</th>
                    <td>{{ $post->category->name()}}</td>
                    <th>{{__('Backend/posts.author')}}</th>
                    <td>{{ $post->user->name}}</td>
                </tr>
{{--                tags --}}
                <tr>
                    <th>{{__('Backend/posts.tags')}}</th>
                    <td colspan="3">
                        @foreach($post->tags as $tag)
                            <span class="badge badge-primary">{{ $tag->name() }}</span>
                        @endforeach
                    </td>
                <tr>
                    <th>{{__('Backend/posts.description')}}</th>
                    <td colspan="3">{!! $post->description() !!}</td>
                </tr>
                <tr>
                    <th colspan="4"> {{__('Backend/posts.sliders')}}</th>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row">
                            <div class="col-12">
                                @if($post->media->count() > 0)
                                    <ul class="list-group">
                                        @foreach($post->media as $media)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <a href="{{ asset('assets/posts/' . $media->file_name) }}" target="_blank" style="text-decoration: none; color: inherit;">{{ $media->real_file_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="form-group pt-4">
                            <button type="button" class="btn btn-primary" id="download-all-pdfs">{{ __('Backend/posts.download_all') }}</button>
                        </div>
                    </td>
                </tr>
                @else
                    <p>{{__('Backend/posts.no_pdfs')}}</p>
                @endif

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('download-all-pdfs').addEventListener('click', function() {
            window.location.href = "{{ route('admin.posts.downloadAllPdfs', $post->id) }}";
        });
    </script>
@endsection
