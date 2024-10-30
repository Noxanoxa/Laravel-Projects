@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/issues.edit_issue')}}
                {{ $issue->number }}</h6>

            <div class="ml-auto">
                <a href="{{ route('admin.issues.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{ __('Backend/issues.issues') }}</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.issues.update', $issue->id) }}">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="issue_number">{{ __('Backend/issues.number') }}</label>
                            <input type="text" name="issue_number" value="{{ old('issue_number', $issue->issue_number) }}" class="form-control">
                            @error('issue_number')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="issue_date">{{__('Backend/issues.date')}}</label>
                            <input type="date" name="issue_date" class="form-control" value="{{ old('issue_date', $issue->issue_date) }}">
                            @error('issue_date')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="status">{{ __('Backend/issues.status') }}</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $issue->status) == '1' ? 'selected' : '' }}>{{ __('Backend/issues.active') }}</option>
                            <option value="0" {{ old('status', $issue->status) == '0' ? 'selected' : '' }}>{{ __('Backend/issues.inactive') }}</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-12">
                        <label for="posts">{{ __('Backend/posts.posts') }}</label>
                        <div class="form-group">
                            <button type="button" id="select-all" class="btn btn-secondary btn-sm">{{ __('Select All') }}</button>
                            <button type="button" id="deselect-all" class="btn btn-secondary btn-sm">{{ __('Deselect All') }}</button>
                            @foreach($issue->posts as $post)
                                <div class="form-check" data-year="{{ $post->published_at }}">
                                    <input class="form-check-input" type="checkbox" name="posts[]" value="{{ $post->id }}" {{ in_array($post->id, $selectedPosts) ? 'checked' : '' }}>
                                    <label class="form-check-label">
                                        {{ $post->title() }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('posts')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-group pt-4">
                    <button type="submit" class="btn btn-primary">{{ __('Backend/issues.update_issue') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            function filterPostsByDate() {
                let issue_date = $('input[name="issue_date"]').val();
                if (issue_date) {
                    $('.form-check').each(function () {
                        let postDate = $(this).data('year');
                        if (postDate === issue_date) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                } else {
                    $('.form-check').show();
                }
            }

            filterPostsByDate();

            $('input[name="issue_date"]').on('change', function() {
                filterPostsByDate();
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
