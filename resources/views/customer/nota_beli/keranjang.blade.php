@extends('layouts.customer')

@section('content')
    <h1 class="text-center">Pembayaran</h1>

    <section>
        {{-- list barang --}}
        <h2>List Barang</h2>
        <div class="table-responsive">
            <table class="table" id="keranjang">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <p class="text-center">Total : Rp <span id="total" class="text-bold">0</span></p>
    </section>

    <section>
        <h2>Data Pesanan</h2>
        <form action="{{ route('customer.beli.store') }}" method="POST">
            @csrf
            <input type="hidden" name="barang">
            <div class="mb-3">
                <label for="alamatCustomer" class="form-label">Alamat Customer</label>
                <input type="text" class="form-control" id="alamatCustomer" name="alamatCustomer" @error('title') is-invalid @enderror required>
                @error('alamatCustomer')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
                <div id="alamatHelp" class="form-text">Alamat tujuan barang akan dikirimkan</div>
            </div>
            <p class="text-center text-danger">
                Pembayaran akan dilakukan secara COD (Cash On Delivery)
            </p>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" onclick="resetLocalStorage()">Beli</button>
            </div>
        </form>
    </section>
@endsection

@section('js')
    <script>
        // on load window, get data cart and render to table
        window.onload = function() {
            const cartData = localStorage.getItem("cart");
            if (!cartData || cartData.length === 0){
                // redirect back
                window.location.href = "{{ route('customer.beli.index') }}";
            }
            else {
                const cart = JSON.parse(cartData);
                const tbody = document.querySelector("tbody");
                tbody.innerHTML = "";

                let total = 0;
                cart.forEach((item, index) => {
                    const newRow = document.createElement("tr");
                    newRow.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${item.nama}</td>
                        <td>Rp ${formatRupiah(item.harga)}</td>
                        <td>${item.quantity}</td>
                        <td>Rp ${formatRupiah(item.quantity * item.harga)}</td>`;
                    total += item.quantity * item.harga;
                    newRow.setAttribute("data-id", item.id);
                    tbody.appendChild(newRow);

                });

                // set input hidden
                const input = document.querySelector("input[name='barang']");
                input.value = JSON.stringify(cart);

                document.getElementById("total").innerText = formatRupiah(total);
            }
        }

        function formatRupiah(angka) {
            var number_string = angka.toString().replace(/[^,\d]/g, ""),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return rupiah;
        }

        function resetLocalStorage() {
            // cek input lengkap atau tidak
            const alamatCustomer = document.getElementById("alamatCustomer").value;
            if (!alamatCustomer) {
                return;
            }
            localStorage.removeItem("cart");
        }
    </script>
@endsection
