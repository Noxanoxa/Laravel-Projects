@extends('layouts.admin')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{__('Backend/general.dashboard')}}</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>
            {{__('Backend/general.generate_report')}}</a>
    </div>

    <!-- Content Row -->
    <livewire:backend.statistics />


    <!-- Content Row -->
    <livewire:backend.last-post-comments />
@endsection
@section('script')
    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/chart-area-demo.js') }}"></script>
@endsection
