@extends('layouts.wirausaha')

@section('content')
    <h1 class="mx-auto text-center my-3 text-uppercase fw-bold">WELCOME</h1>
    @include('components.alert')
    <div class="shadow-lg rounded col-7 mx-auto d-flex justify-content-center flex-col">
        <a href="{{ @route('wirausaha.barang') }}" class="btn btn-dark w-100 m-2">Manage Barang</a>
        <a href="{{ @route('wirausaha.offer') }}" class="btn btn-dark w-100 m-2">Manage Offer</a>
        
    </div>
@endsection

