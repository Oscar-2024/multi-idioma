@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <x-flash-message
                :status="session('status')"
                :message="session('message')"
            />

            <!-- articles list -->
            <div class="col-md-7">
                @include('articles.list')
            </div>

            <!-- sidebar categories -->
            <div class="col-md-5">
                @include('categories.sidebar')
            </div>
        </div>
    </div>
@endsection
