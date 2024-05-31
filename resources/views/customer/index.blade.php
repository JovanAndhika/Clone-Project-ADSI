@extends('layouts.customer')

@section('content')
    <h1 class="text-center">Customer View</h1>
    @include('components.alert')
    <a class="btn btn-primary" href="{{ route('customer.beli.index') }}" role="button">Beli</a>
    <a class="btn btn-danger" href="{{ route('customer.jual.index') }}" role="button">Jual</a>

    @if ($notaBeli->count() > 0)
        <section>
            <h2>Pesanan In Progress</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tanggal Pesan</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notaBeli as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    @if ($item->status)
                                        Lunas
                                    @else
                                        Belum Lunas
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    @endif

    @if ($notaJual->count() > 0)
        <section>
            <h2>Barang Dijual</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tanggal Jual</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Status</th>
                            <th scope="col">Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notaJual as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->harga }}</td>
                                <td>
                                    @if ($item->status == 0)
                                        <div class="px-2 py-1 bg-info text-center text-light rounded">
                                            Pending
                                        </div>
                                    @elseif($item->status == 1)
                                        <div class="px-2 py-1 bg-success text-center text-light rounded">
                                            Approved
                                        </div>
                                    @else
                                        <div class="px-2 py-1 bg-danger text-center text-light rounded">
                                            Rejected
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn" data-bs-toggle="modal" data-bs-target="#modalFotoBarang"
                                        data-foto="{{ $item->foto }}">
                                        <i class="bi bi-card-image"></i></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    @endif
@endsection

@section('extras')
    {{-- modal foto --}}
    <div class="modal fade" id="modalFotoBarang" tabindex="-1" data-id="0">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalFotoBarang">Foto Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="" style="max-width:100%">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the modal element
            var modalFotoBarang = document.getElementById('modalFotoBarang');

            // Add event listener for showing the modal
            modalFotoBarang.addEventListener('show.bs.modal', function(event) {
                // Get the button that triggered the modal
                var button = event.relatedTarget;

                // Extract value from data-foto attribute
                var fotoSrc = button.getAttribute('data-foto');

                // Get the modal body element
                var modalBody = modalFotoBarang.querySelector('.modal-body');

                // Set the src attribute of the img tag
                modalBody.querySelector('img').src = `{{ asset('storage/` + fotoSrc + `') }}`;
            });
        });
    </script>
@endsection
