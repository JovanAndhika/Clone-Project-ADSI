@extends('layouts.main')

@section('css')
{{-- Sidebar CSS --}}
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<style>
    /* section {
            margin: 3rem 0;
            padding: 1rem 3rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        } */
</style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    .wrapper {
        height: 100%;
        width: 330px;
        position: relative;
    }

    input[type="checkbox"] {
        display: none;
    }

    .wrapper .menu-btn {
        position: absolute;
        top: 10px;
        left: 20px;
        height: 45px;
        width: 45px;
        z-index: 1000;
        color: #f1f1f1;
        background: #50577a;
        border: 1px solid #333;
        text-align: center;
        line-height: 45px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 40px;
        transition: all 0.3s ease;
    }

    #btn-sidebar:checked~.menu-btn {
        left: 247px;
    }

    #btn-sidebar:checked~.menu-btn i:before {
        position: absolute;
        top: 7px;
        left: 7px;
        font-size: 30px;
        content: "\F159";
    }

    .wrapper #sidebar {
        position: fixed;
        height: 100%;
        width: 270px;
        background: #474e68;
        overflow: hidden;
        left: -270px;
        transition: all 0.3s ease;
        z-index: 999;
    }

    #btn-sidebar:checked~#sidebar {
        left: 0;
    }

    #sidebar .title {
        color: #f2f2f2;
        font-size: 25px;
        font-weight: 600;
        line-height: 65px;
        background: #404258;
        text-align: center;
    }

    #sidebar .list-items {
        position: relative;
        background: #474e68;
        height: 100%;
        list-style: none;
    }

    #sidebar .list-items li {
        padding-left: 40px;
        line-height: 50px;
        border-top: 1px solid rgba(255, 255, 255, 0.3);
        border-bottom: 1px solid #333;
        background: #474e68;
    }

    #sidebar .list-items li:hover,
    #sidebar .list-items a:hover {
        background: #ff004d;
        border-top: 1px solid transparent;
        border-bottom: 1px solid transparent;
    }

    #sidebar .list-items li a {
        color: #f1f1f1;
        background: #474e68;
        text-decoration: none;
        font-size: 18px;
        font-weight: 500;
        height: 100%;
        width: 100%;
        display: block;
    }

    #sidebar .list-items li a i {
        margin-right: 20px;
    }

    #sidebar ul {
        padding-left: 0 !important;
    }
</style>
@endsection

@section('components')
@include('customer.components.sidebar')
@endsection