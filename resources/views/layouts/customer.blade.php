@extends('layouts.main')

@section('css')
    {{-- Sidebar CSS --}}
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <style>
        section {
            margin: 3rem 0;
            padding: 1rem 3rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
    </style>
@endsection

@section('components')
    @include('customer.components.sidebar')
@endsection