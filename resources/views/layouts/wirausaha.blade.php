@extends('layouts.main')

@section('css')
    {{-- Sidebar CSS --}}
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    
@endsection

@section('components')
    @include('wirausaha.components.sidebar')
@endsection