@extends('layouts.customer')

@section('content')
    <h1 class="mx-auto text-center my-3 mb-5 text-uppercase fw-bold">Beli Barang</h1>

    {{-- list keranjang --}}
    <div class=" shadow-lg rounded bg-light bg-opacity-50 p-3">
        <h2 class="text-center">My Cart</h2>
        <div class="table-responsive">
            <table class="table" id="keranjang">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Nomor</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="placeholder">
                        <td colspan="6" class="text-center">List keranjang masih kosong</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- button beli --}}
        <div class="d-flex justify-content-center">
            <button class="btn btn-primary" onclick="beliBarang()">Beli</button>
        </div>
    </div>


    {{-- list beli barang --}}
    <div class=" shadow-lg rounded bg-light bg-opacity-50 p-3 mt-4">
        <h2 class="text-center">You Might Interest...</h2>

        {{-- search --}}
        <form action="{{ route('customer.beli.index') }}" method="GET" class="mb-5">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search..." name="search"
                    value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>

        <div class="row justify-content-center g-3">
            @foreach ($barang as $item)
                <div class="col-10 col-md-6">
                    <div class="card shadow">
                        <img src="@if($item->foto == null) https://source.unsplash.com/random/{{ rand(1, 100) }} @else {{ asset($item->foto) }} @endif" class="card-img-top" style="height: 150px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $item->nama }}</h5>
                            <p class="card-text">
                                Harga : Rp {{ number_format($item->harga, 0, ',', '.') }}<br>
                                Stock : {{ $item->stock }}
                            </p>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-outline-primary rounded-5" data-bs-toggle="modal"
                                    data-bs-target="#modalBeli" data-nama="{{ $item->nama }}"
                                    data-harga="{{ $item->harga }}" data-stock="{{ $item->stock }}"
                                    data-id="{{ $item->id }}"
                                    data-foto="{{ $item->foto }}"
                                    data-detail="{{ $item->detail }}">
                                    <i class="bi bi-bag-plus-fill"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- pagination --}}
        <div class="d-flex justify-content-center mt-5">
            {{ $barang->links() }}
        </div>
    </div>
@endsection

@section('modal')
    {{-- modal beli --}}
    <div class="modal fade" id="modalBeli" tabindex="-1" data-id="0">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalBeli">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="" id="foto" class="img-fluid" alt="Product Image" style="height: 200px; width:100%; object-fit: cover;">
                    <div>
                        <p>
                            Nama Barang : <span id="nama"></span><br>
                            Harga : <span id="harga"></span><br>
                            Stock : <span id="stock"></span>
                        </p>
                        <p id="deskripsi"></p>
                    </div>

                    {{-- input number --}}
                    <div class="form-floating">
                        <input min="10" max="20" type="number" id="quantity" class="form-control" />
                        <label class="form-label" for="quantity">Quantity</label>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="addToCart()">Add To
                        Cart</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/beli.js') }}"></script>
    <script>
        function beliBarang() {
            // cek keranjang dari local storage
            let keranjang = JSON.parse(localStorage.getItem('cart'));
            console.log(keranjang);
            if (keranjang == null || keranjang.length == 0) {
                alert('Keranjang masih kosong');
                return;
            }
            else {
                // redirect ke halaman beli
                window.location.href = '{{ route('customer.beli.create') }}';
            }
        }
    </script>
@endsection