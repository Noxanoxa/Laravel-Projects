<!-- resources/views/backend/volumes/edit.blade.php -->
@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/volumes.edit_volume')}}
                {{ $volume->number }}</h6>

            <div class="ml-auto">
                <a href="{{route('admin.volumes.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{__('Backend/volumes.volumes')}}</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.volumes.update', $volume->id) }}" id="update-volume-form">
                @csrf
                @method('PATCH')

                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="number">{{__('Backend/volumes.number')}}</label>
                            <input type="text" name="number" value="{{ old('number', $volume->number) }}" class="form-control">
                            @error('number')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="year">{{__('Backend/volumes.year')}}</label>
                            <input type="text" name="year" value="{{ old('year', $volume->year) }}" class="form-control">
                            @error('year')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="status">{{__('Backend/volumes.status')}}</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $volume->status) == 1 ? 'selected' : '' }}>{{__('Backend/volumes.active')}}</option>
                            <option value="0" {{ old('status', $volume->status) == 0 ? 'selected' : '' }}>{{__('Backend/volumes.inactive')}}</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-12">
                        <label for="issues">{{__('Backend/issues.issues')}}</label>
                        <div class="form-group">
                            @foreach($issues as $issue)
                                <input type="hidden" name="issue_id[]" value="{{ $issue->id }}">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="issue_number">{{__('Backend/issues.number')}}</label>
                                            <input type="text" name="issue_number[]" class="form-control" value="{{ old('issue_number', $issue->issue_number) }}">
                                            @error('issue_number[]')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="issue_date">{{__('Backend/issues.date')}}</label>
                                            <input type="date" name="issue_date[]" class="form-control" value="{{ old('issue_date', $issue->issue_date) }}">
                                            @error('issue_date[]')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-4 d-flex align-items-center">
                                        <a href="{{ route('admin.issues.edit', $issue->id) }}" class="btn btn-warning mr-2">{{__('Backend/issues.edit_issue')}}</a>
                                        <button type="button" class="btn btn-danger delete-issue" data-id="{{ $issue->id }}">{{__('Backend/issues.delete_issue')}}</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if(! ($volume->issues->count() > 2))
                            <a href="{{ route('admin.issues.create', ['volume_id' => $volume->id]) }}" class="btn btn-success">{{__('Backend/issues.add_issue')}}</a>
                        @endif
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" class="btn btn-primary">{{ __('Backend/volumes.update_volume') }}</button>
                </div>

            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

                $('.delete-issue').click(function() {
                    var issueId = $(this).data('id');
                    if (confirm('{{__('backend/issues.are_you_sure')}}')) {
                        $.ajax({
                            url: '{{ url('admin/issues') }}/' + issueId,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                alert(response.message);
                                location.reload();
                            },
                            error: function(response) {
                                alert(response);
                                location.reload();
                                // alert('Error deleting issue');
                            }
                        });
                    }
                });


            function filterPostsByYear() {
                var volumeYear = $('input[name="year"]').val();

                if (volumeYear) {
                    $('.form-check').each(function() {
                        var postDate = $(this).data('year');

                        if (postDate == volumeYear) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                } else {
                    $('.form-check').hide();
                }
            }

            // Initially filter posts by the current year value
            filterPostsByYear();

        // Add change event listener to the year input
            // Add change event listener to the year input
            $('input[name="year"]').on('change', function() {
                filterPostsByYear();
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
