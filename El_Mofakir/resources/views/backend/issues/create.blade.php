<!-- resources/views/backend/issues/create.blade.php -->
@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/issues.create_issue')}}</h6>
            <div class="ml-auto">
                <a href="{{route('admin.issues.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{__('Backend/issues.issues')}}</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('admin.issues.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="number">{{__('Backend/issues.number')}}</label>
                            <input type="text" name="number" class="form-control" value="{{old('number')}}">
                            @error('number')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="issue_date">{{__('Backend/issues.date')}}</label>
                            <input type="date" name="issue_date" class="form-control" value="{{old('issue_date', $issueDate)}}">
                            @error('issue_date')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="status">{{__('Backend/issues.status')}}</label>
                        <select name="status" class="form-control">
                            <option value="1" {{old('status') == '1' ? 'selected' : ''}}>{{__('Backend/issues.active')}}</option>
                            <option value="0" {{old('status') == '0' ? 'selected' : ''}}>{{__('Backend/issues.inactive')}}</option>
                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                        </select>
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-12">
                        <label for="volume_id">{{__('Backend/issues.volume')}}</label>
                        <select name="volume_id" class="form-control">
                            <option value="">{{__('Backend/issues.select_volume')}}</option>
                            @foreach($volumes as $volume)
                                <option value="{{$volume->id}}" data-year="{{$volume->year}}">
                                    {{__('Backend/volumes.volume')}} {{$volume->number}} ({{$volume->year}})
                                </option>
                            @endforeach
                        </select>
                        @error('volume_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-12">
                        <label for="posts">{{__('Backend/posts.posts')}}</label>
                        <div class="form-group">
                            <button type="button" id="select-all" class="btn btn-secondary btn-sm">{{ __('Select All') }}</button>
                            <button type="button" id="deselect-all" class="btn btn-secondary btn-sm">{{ __('Deselect All') }}</button>
                            @foreach($posts as $post)
                                <div class="form-check" data-date="{{$post->created_at->format('Y-m-d')}}">
                                    <input class="form-check-input" type="checkbox" name="posts[]" value="{{$post->id}}">
                                    <label class="form-check-label">
                                        {{$post->title()}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('posts')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" class="btn btn-primary">{{__('Backend/issues.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            function filterbyIssueDate() {
                let issueDate =$('input[name="issue_date"]').val();
                let issueYear = new Date(issueDate).getFullYear();
                if (issueDate) {
                    $('select[name="volume_id"] option').each(function() {
                        var  volumeYear = $(this).data('year');

                        if (volumeYear == issueYear) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });

                    $('.form-check').each(function() {
                        let postDate = $(this).data('date');
                        if (postDate.split('-')[0] == issueYear) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                } else {
                    $('select[name="volume_id"] option').hide();
                    $('.form-check').hide();
                }
            }

            filterbyIssueDate();


            $('input[name="issue_date"]').on('change', function() {
                filterbyIssueDate();
            });

            $('#select-all').click(function() {
                $('input[name="posts[]"]').prop('checked', true);
            });

            $('#deselect-all').click(function() {
                $('input[name="posts[]"]').prop('checked', false);
            });
        });
    </script>
@endsection
