@extends('layouts.driver')

@section('content')
    <!-- Tugas Belum Diambil -->
    <!-- <section>
        <style>
            /* Modal konten */
            .modal-content {
                width: 550px !important;
            }
        </style>


        <div class="maintable">
            <main class="table" id="customers_table">
                <div class="table__header">
                    <h1>LIST TUGAS DRIVER</h1>
                    <div class="input-group">
                        <input type="search" placeholder="Search Data...">
                        <img src="{{ asset('images/search.png') }}" alt="">
                    </div>
                </div>
                <div class="table__body">
                    <table>
                        <thead>
                            <tr>
                                <th> No <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Pelanggan <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Alamat <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Tugas Mulai <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Jenis Tugas <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Status <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Detail <span class="icon-arrow">&UpArrow;</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list_tugas_beli_berlangsung as $taken)
                            <tr>
                                <td> {{ $loop->iteration }} </td>
                                <td> {{ $taken->nama_penerima }}</td>
                                <td> {{ $taken->nota_beli->alamat_customer }} </td>
                                <td> {{ $taken->nota_beli->created_at }}</td>
                                <td> {{ $taken->jenis_tugas }}</td>
                                <td>
                                    <p class="status shipped">{{ $taken->status }}</p>
                                </td>
                                <td>
                                  
                                    <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBerlangsung{{$loop->iteration}}">
                                        Detail Tugas
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            @foreach ($list_tugas_jual_berlangsung as $taken_jual)
                            <tr>
                                <td> {{ $loop->iteration }} </td>
                                <td> {{ $taken_jual->nama_penerima }}</td>
                                <td> {{ $taken_jual->nota_jual->alamat }} </td>
                                <td> {{ $taken_jual->nota_jual->created_at }}</td>
                                <td> {{ $taken_jual->jenis_tugas }}</td>
                                <td>
                                    <p class="status shipped">{{ $taken_jual->status }}</p>
                                </td>
                                <td>
                                    
                                    <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalJualBerlangsung{{$loop->iteration}}">
                                        Detail Tugas
                                    </button>
                                </td>
                            </tr>
                            @endforeach




                           
                            @foreach ($list_tugas_beli as $tugas)
                            <tr>
                                <td> {{ $loop->iteration }} </td>
                                <td> {{ $tugas->nama_penerima }}</td>
                                <td> {{ $tugas->nota_beli->alamat_customer }} </td>
                                <td> {{ $tugas->nota_beli->created_at }}</td>
                                <td> {{ $tugas->jenis_tugas }}</td>
                                <td>
                                    <p class="status pending">{{ $tugas->status }}</p>
                                </td>
                                <td>
                                 
                                    <button type="submit" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalBlmDiambil{{$loop->iteration}}">
                                        Detail Tugas
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            @foreach ($list_tugas_jual as $tugas_jual)
                            <tr>
                                <td> {{ $loop->iteration }} </td>
                                <td> {{ $tugas_jual->nama_penerima }}</td>
                                <td> {{ $tugas_jual->nota_jual->alamat }} </td>
                                <td> {{ $tugas_jual->nota_jual->created_at }}</td>
                                <td> {{ $tugas_jual->jenis_tugas }}</td>
                                <td>
                                    <p class="status pending">{{ $tugas_jual->status }}</p>
                                </td>
                                <td>
                                 
                                    <button type="submit" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalJualBlmDiambil{{$loop->iteration}}">
                                        Detail Tugas
                                    </button>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </main>
        </div>
        <script>
            const search = document.querySelector('.input-group input'),
                table_rows = document.querySelectorAll('tbody tr'),
                table_headings = document.querySelectorAll('thead th');

            // 1. Searching for specific data of HTML table
            search.addEventListener('input', searchTable);

            function searchTable() {
                table_rows.forEach((row, i) => {
                    let table_data = row.textContent.toLowerCase(),
                        search_data = search.value.toLowerCase();

                    row.classList.toggle('hide', table_data.indexOf(search_data) < 0);
                    row.style.setProperty('--delay', i / 25 + 's');
                })

                document.querySelectorAll('tbody tr:not(.hide)').forEach((visible_row, i) => {
                    visible_row.style.backgroundColor = (i % 2 == 0) ? 'transparent' : '#0000000b';
                });
            }

            // 2. Sorting | Ordering data of HTML table

            table_headings.forEach((head, i) => {
                let sort_asc = true;
                head.onclick = () => {
                    table_headings.forEach(head => head.classList.remove('active'));
                    head.classList.add('active');

                    document.querySelectorAll('td').forEach(td => td.classList.remove('active'));
                    table_rows.forEach(row => {
                        row.querySelectorAll('td')[i].classList.add('active');
                    })

                    head.classList.toggle('asc', sort_asc);
                    sort_asc = head.classList.contains('asc') ? false : true;

                    sortTable(i, sort_asc);
                }
            })


            function sortTable(column, sort_asc) {
                [...table_rows].sort((a, b) => {
                        let first_row = a.querySelectorAll('td')[column].textContent.toLowerCase(),
                            second_row = b.querySelectorAll('td')[column].textContent.toLowerCase();

                        return sort_asc ? (first_row < second_row ? 1 : -1) : (first_row < second_row ? -1 : 1);
                    })
                    .map(sorted_row => document.querySelector('tbody').appendChild(sorted_row));
            }
        </script>
    </section>



 
    @foreach($list_tugas_beli_berlangsung as $taken)
    <div class="modal fade" id="modalBerlangsung{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pengantaran Berlangsung</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('images/petalokasi.jpg') }}" style="width: 500px;">
                    <p>Id Nota: {{ $taken->nota_beli_id }}</p>
                    <p>Alamat: {{ $taken->nota_beli->alamat_customer }}</p>
                    <p>Nama penerima: {{ $taken->nama_penerima }}</p>
                    <p>Jenis tugas: {{ $taken->jenis_tugas }}</p>

                  
                    @foreach ($taken->nota_beli->barang as $barang)
                    <p>Nama barang: {{$barang->nama}}</p>
                    <p>Jumlah barang: {{ $barang->pivot->jumlah }}</p>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form method="post" action="{{ route('tugasSelesaiAntar', ['idTugas' => $taken->id]) }}">
                        @csrf
                        <input type="hidden" name="notaBeliId" value="{{ $taken->nota_beli_id }}">
                        <button type="submit" id="btn-TugasSelesaiAntar" class="btn btn-success">Tugas Selesai</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
   

    
    @foreach($list_tugas_jual_berlangsung as $taken_jual)
    <div class="modal fade" id="modalJualBerlangsung{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Penjemputan Berlangsung</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('images/petalokasi.jpg') }}" style="width:500px">
                    <p>Nomor Nota: {{ $taken_jual->nota_jual_id }}</p>
                    <p>Alamat: {{ $taken_jual->nota_jual->alamat }}</p>
                    <p>Nama penerima: {{ $taken_jual->nama_penerima }}</p>
                    <p>Jenis tugas: {{ $taken_jual->jenis_tugas }}</p>

                    
                    <p>Nama barang: {{$taken_jual->nota_jual->nama}}</p>
                    <p>Harga barang: {{ $taken_jual->nota_jual->harga }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form method="post" action="{{ route('tugasSelesai', ['idTugas' => $taken_jual->id]) }}">
                        @csrf
                        <button type="submit" id="btn-TugasSelesai" class="btn btn-success">Tugas Selesai</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    
    @foreach ($list_tugas_beli as $tugas)
    <div class="modal fade" id="modalBlmDiambil{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pengantaran Belum Diambil</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('images/petalokasi.jpg') }}" style="width:500px">
                    <p>Nomor Nota: {{ $tugas->nota_beli_id }}</p>
                    <p>Alamat: {{ $tugas->nota_beli->alamat_customer }}</p>
                    <p>Nama penerima: {{ $tugas->nama_penerima }}</p>
                    <p>Jenis tugas: {{ $tugas->jenis_tugas }}</p>

                 
                    @foreach ($tugas->nota_beli->barang as $barang)
                    <p>Nama barang: {{$barang->nama}}</p>
                    <p>Jumlah barang: {{ $barang->pivot->jumlah }}</p>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form method="post" action="{{ route('ambilTugas', ['idTugas' => $tugas->id]) }}">
                        @csrf
                        <button type="submit" id="btn-AmbilTugas" class="btn btn-warning">Ambil tugas</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    

    @foreach ($list_tugas_jual as $tugas_jual)
    <div class="modal fade" id="modalJualBlmDiambil{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Penjemputan Belum Diambil</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('images/petalokasi.jpg') }}" style="width:500px">
                    <p>Nomor Nota: {{ $tugas_jual->nota_beli_id }}</p>
                    <p>Alamat: {{ $tugas_jual->nota_jual->alamat }}</p>
                    <p>Nama penerima: {{ $tugas_jual->nama_penerima }}</p>
                    <p>Jenis tugas: {{ $tugas_jual->jenis_tugas }}</p>

                   
                    <p>Nama barang: {{$tugas_jual->nota_jual->nama}}</p>
                    <p>Harga barang: {{ $tugas_jual->nota_jual->harga }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form method="post" action="{{ route('ambilTugas', ['idTugas' => $tugas_jual->id]) }}">
                        @csrf
                        <button type="submit" id="btn-AmbilTugas" class="btn btn-warning">Ambil tugas</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach -->
    <!-- END OF MODAL -->
@endsection