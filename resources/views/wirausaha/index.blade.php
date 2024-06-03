@extends('layouts.wirausaha')

@section('content')
    <div class="d-flex align-items-center justify-content-center" style="min-height:500px">
        <div class="col-7 rounded bg-light py-2 bg-opacity-50">

            <h1 class="mx-auto text-center my-3 text-uppercase fw-bold">WELCOME</h1>
            @include('components.alert')
            <div class="shadow-lg rounded mx-auto text-center">
                <a href="{{ @route('wirausaha.barang') }}" class="btn btn-dark w-75 text-center p-2 my-2 d-inline-block">Manage Barang</a>
                <a href="{{ @route('wirausaha.offer') }}" class="btn btn-dark w-75 text-center p-2 my-2 d-inline-block">Manage Offer</a>

            </div>
        </div>
    </div>
@endsection
