@extends('layouts.wirausaha')

@section('content')
    <h1 class="mx-auto text-center my-3">Wirausaha View</h1>
    @include('components.alert')
    <form action="/wirausaha.get" method="post" class="mx-auto d-flex flex-column justify-content-center">
        <input type="text" name=nama id="nama" class="form-control p-2 my-2 w-75 mx-auto" placeholder="Nama Barang">
        <input type="number" name=harga id="harga" class="form-control p-2 my-2 w-75 mx-auto" placeholder="Harga Barang">
        <input type="number" name=stok id="stok" class="form-control p-2 my-2 w-75 mx-auto" placeholder="Stok Barang" max="999">
        <select class="form-select p-2 my-2 w-50 mx-auto" aria-label="Default select example">
            <option selected>Other</option>
            @foreach ($jenis as $jen)
                <option value="{{$jen->id}}">{{$jen->nama}}</option>
            @endforeach
          </select>
        <input type="submit" id="submit" class="btn btn-primary p-2 my-2 mx-auto w-50">
    </form>
    <div class="my-4" style="position: absolute; left: 50%; transform: translateX(-50%);width: 600px; margin:auto">
        <table class="d-block table table-hover table-bordered table-striped mx-auto" id="barangtable">
            <thead class="w-100">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="w-100">
                @foreach ($barang as $index => $w)
                    <tr>
                        <th scope="row">{{$index+1}}</th>
                        <td>{{$w->nama}}</td>
                        <td>{{$w->harga}}</td>
                        <td>{{$w->stock}}</td>
                        <td>{{$w->jenisbarang->nama}}</td>
                        <td>
                            <button href="/wirausaha.edit/{{$w->id}}" class="btn btn-warning p-1 mx-1"><i class="bi bi-pencil-square"></i></button>
                            <button href="/wirausaha.delete/{{$w->id}}" class="btn btn-danger p-1 mx-1"><i class="bi bi-trash3-fill"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        

    </div>

    

@endsection


@section('js')
    <script>
        $(document).ready(function() {

           
            new DataTable('#barangtable');

            // $('#submit').click(function() {
            //     var nama = $('#nama').val();
            //     var harga = $('#harga').val();
            //     var stok = $('#stok').val();
            //     var jenis = $('#jenis').val();
            //     $.ajax({
            //         url: '/wirausaha.get',
            //         type: 'post',
            //         data: {
            //             nama: nama,
            //             harga: harga,
            //             stok: stok,
            //             jenis: jenis
            //         },
            //         success: function(data) {
            //             console.log(data);
            //         }
            //     });
            // });
        });
    </script>
    
@endsection

{{-- @section('css') --}}
    {{-- <style>
        h1 {
            color: red;
        }
    </style> --}}
{{-- @endsection --}}