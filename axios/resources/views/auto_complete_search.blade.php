@extends('layouts.app')

@section('title', 'Auto Complete Search')
@section('project_title', 'Auto Complete Search')

@section('content')
    <div id="auto_complete">
        <div class="d-flex">
            <h5 class="mt-1 px-5">Search</h5>
            <input type="text" class="form-control" id="searchField" placeholder="Search Anything....">
        </div>
        <div id="searchingItems" style="margin-left: 145px;margin-top:10px">
            <ul>
                <li><a href="">Test</a></li>
            </ul>
        </div>
    </div>
@stop

@push('script')
    <script>
        log('ok')
    </script>
@endpush
