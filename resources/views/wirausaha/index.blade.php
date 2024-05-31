@extends('layouts.wirausaha')

@section('content')
    <h1 class="mx-auto text-center my-3">Wirausaha View</h1>
    @include('components.alert')

    <form action={{ @route('wirausaha.add') }} method="POST" class="mx-auto d-flex flex-column justify-content-center">
        @csrf
        <input type="text" name=nama id="nama"
            class="form-control p-2 mt-2 w-75 mx-auto @error('nama') is-invalid @enderror" placeholder="Nama Barang">
        @error('nama')
            <div class="invalid-feedback mx-auto w-75">
                {{ $message }}
            </div>
        @enderror
        <input type="number" name=harga id="harga"
            class="form-control p-2 mt-2 w-75 mx-auto @error('harga') is-invalid @enderror" placeholder="Harga Barang">
        @error('harga')
            <div class="invalid-feedback mx-auto w-75">
                {{ $message }}
            </div>
        @enderror
        <input type="number" name=stock id="stok"
            class="form-control p-2 mt-2 w-75 mx-auto @error('stock') is-invalid @enderror" placeholder="Stok Barang"
            max="999">
        @error('stock')
            <div class="invalid-feedback mx-auto w-75">
                {{ $message }}
            </div>
        @enderror
        <select class="form-select p-2 my-2 w-50 mx-auto" aria-label="Default select example" name="jenis_barang_id">
            @foreach ($jenis as $jen)
                <option value="{{ $jen->id }}">{{ $jen->nama }}</option>
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
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $w->nama }}</td>
                        <td>{{ $w->harga }}</td>
                        <td>{{ $w->stock }}</td>
                        <td>{{ $w->jenisbarang->nama }}</td>
                        <td>
                            <span class="d-none id" id="{{ $w->id }}">{{ $w->id }}</span>
                            <span class="d-none" id="Pnama{{ $w->id }}">{{$w->nama}}</span>
                            <span class="d-none" id="Pprice{{ $w->id }}" >{{$w->harga}}</span>
                            <span class="d-none" id="Pstock{{ $w->id }}">{{$w->stock}}</span>
                            <span class="d-none" id="Pcate{{ $w->id }}">{{$w->jenis_barang_id}}</span>

                            <button class="btn btn-warning p-1 mx-1 editButton" data-bs-toggle="modal" data-bs-target="#editModal" id="editButton"><i
                                    class="bi bi-pencil-square"></i></button>
                            <form action={{ @route('wirausaha.delete') }} method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <input type="hidden" name="barang_id" value="{{ $w->id }}">
                                <button type='submit' class="btn btn-danger mx-1 p-1 d-inline border-0"
                                    onclick="return confirm('Are You Sure')"><i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judulModal">Update Data Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <form action={{ @route('wirausaha.update') }} method="Post"
                    class="mx-auto d-flex flex-column justify-content-center w-100">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="barang_id" id="barang_id">

                        <input type="text" name=nama id="nama"
                            class="form-control p-2 mt-2 w-100 mx-auto @error('nama') is-invalid @enderror"
                            placeholder="Nama Barang">
                        @error('nama')
                            <div class="invalid-feedback mx-auto w-100">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="number" name=harga id="harga"
                            class="form-control p-2 mt-2 w-100 mx-auto @error('harga') is-invalid @enderror"
                            placeholder="Harga Barang">
                        @error('harga')
                            <div class="invalid-feedback mx-auto w-100">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="number" name=stock id="stock"
                            class="form-control p-2 mt-2 w-100 mx-auto @error('stock') is-invalid @enderror"
                            placeholder="Stok Barang" max="999">
                        @error('stock')
                            <div class="invalid-feedback mx-auto w-100">
                                {{ $message }}
                            </div>
                        @enderror
                        <select class="form-select p-2 my-2 w-100 mx-auto  @error('jenis_barang_id') is-invalid @enderror" aria-label="Default select example"
                            name="jenis_barang_id" id="jenis_barang_id">
                            @foreach ($jenis as $jen)
                                <option value="{{ $jen->id }}">{{ $jen->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary w-25">Save</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            new DataTable('#barangtable');
            $('.editButton').click(function() {

                let modal = $('#editModal');
                let id = $(this).siblings("span.id").text();
                console.log(id);

                if (modal.length === 0) {
                    console.error('Modal not found');
                    return;
                }
                modal.find('#barang_id').val(id);
                modal.find('#nama').val($('#Pnama'+id).text());
                modal.find('#harga').val($('#Pprice'+id).text());
                modal.find('#stock').val($('#Pstock'+id).text());
                modal.find('#jenis_barang_id').val($('#Pcate'+id).text());

            });


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
