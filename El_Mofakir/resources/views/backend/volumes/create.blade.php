@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/volumes.create_volume')}}</h6>
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
            <form action="{{route('admin.volumes.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="number">{{__('Backend/volumes.number')}}</label>
                            <input type="text" name="number" class="form-control" value="{{old('number')}}">
                            @error('number')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="year">{{__('Backend/volumes.year')}}</label>
                            <input type="text" name="year" class="form-control" value="{{old('year')}}">
                            @error('year')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="status">{{__('Backend/volumes.status')}}</label>
                        <select name="status" class="form-control">
                            <option value="1" {{old('status') == '1' ? 'selected' : ''}}>{{__('Backend/volumes.active')}}</option>
                            <option value="0" {{old('status') == '0' ? 'selected' : ''}}>{{__('Backend/volumes.inactive')}}</option>
                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                        </select>
                    </div>
                </div>

                <!-- New Issue Section -->
                <div class="row pt-4">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="issue_number">{{__('Backend/issues.number')}}</label>
                            <input type="text" name="issue_number" class="form-control" value="{{old('issue_number')}}">
                            @error('issue_number')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="issue_date">{{__('Backend/issues.date')}}</label>
                            <input type="date" name="issue_date" class="form-control" value="{{old('issue_date')}}">
                            @error('issue_date')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>



                <div class="form-group pt-4">
                    <button type="submit" class="btn btn-primary">{{__('Backend/volumes.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('input[name="year"]').on('change', function() {
                var volumeYear = $(this).val();


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
            });

            // Initially hide  and post option
            $('.form-check').hide();
        });
    </script>
@endsection
