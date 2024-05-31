@extends('layouts.wirausaha')

@section('content')
    <h1 class="mx-auto text-center my-3">Wirausaha View</h1>
    @include('components.alert')
    <form action="/wirausaha.get" method="post" class="mx-auto">
        <input type="text" name=nama id="nama" class="form-control p-2 my-2" placeholder="Nama Barang">
        <input type="number" name=harga id="harga" class="form-control p-2 my-2" placeholder="Harga Barang">
        <input type="number" name=stok id="stok" class="form-control p-2 my-2" placeholder="Stok Barang" max="999">
        <select class="form-select p-2 my-2" aria-label="Default select example">
            <option selected>Other</option>
            @foreach ($jenis as $jen)
                <option value="{{$jen->id}}">{{$jen->nama}}</option>
            @endforeach
          </select>
        <input type="submit" id="submit" class="btn btn-primary p-2 my-2">
    </form>

    <table class="table table-striped table-hover mx-auto my-5">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Harga</th>
                <th scope="col">Stok</th>
                <th scope="col">Jenis</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($wirausaha as $index => $w)
                <tr>
                    <th scope="row">{{$index+1}}</th>
                    <td>{{$w->nama}}</td>
                    <td>{{$w->harga}}</td>
                    <td>{{$w->stok}}</td>
                    <td>{{$w->jenis}}</td>
                    <td>
                        <a href="/wirausaha.edit/{{$w->id}}" class="btn btn-warning">Edit</a>
                        <a href="/wirausaha.delete/{{$w->id}}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    

@endsection

{{-- @section('css') --}}
    {{-- <style>
        h1 {
            color: red;
        }
    </style> --}}
{{-- @endsection --}}