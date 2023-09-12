@extends('backend.layouts.master')
@section('title') {{'Suppliers'}} @endsection
@section('content')
    @include('backend.partials.alert')

    <a href="{{ route('now') }}">Start Now</a>
@endsection
