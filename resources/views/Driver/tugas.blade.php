<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Driver | Tugas</title>
</head>

<body>
    @include('driver.components.sidebar')
    <!-- Tugas Belum Diambil -->
    <section>
        <style>
            * {
                margin: 0;
                padding: 0;

                box-sizing: border-box;
                font-family: sans-serif;
            }

            @media print {

                .table,
                .table__body {
                    overflow: visible;
                    height: auto !important;
                    width: auto !important;
                }
            }

            body {
                min-height: 100vh;
                display: flex;
            }

            ul.list-items{
                padding-left: 0;
            }

            .belum_diambil{
                padding-top: 2%;
            }

            main.table {
                padding-top: 20px;
                width: 82vw;
                height: 90vh;
                background-color: #fff5;
                
                backdrop-filter: blur(7px);
                box-shadow: 0 .4rem .8rem #0005;
                border-radius: .8rem;

                overflow: hidden;
            }

            .table__header {
                width: 100%;
                height: 10%;
                background-color: #fff4;
                padding: .8rem 1rem;

                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .table__header .input-group {
                width: 35%;
                height: 100%;
                background-color: #fff5;
                padding: 0 .8rem;
                border-radius: 2rem;

                display: flex;
                justify-content: center;
                align-items: center;

                transition: .2s;
            }

            .table__header .input-group:hover {
                width: 45%;
                background-color: #fff8;
                box-shadow: 0 .1rem .4rem #0002;
            }

            .table__header .input-group img {
                position: absolute;
                right: 1%;
                width: 30px;
                height: 30px;
            }

            .table__header .input-group input {
                width: 100%;
                padding: 0 .5rem 0 .3rem;
                background-color: transparent;
                border: none;
                outline: none;
            }

            .table__body {
                width: 95%;
                max-height: calc(89% - 1.6rem);
                background-color: #fffb;

                margin: .8rem auto;
                border-radius: .6rem;

                overflow: auto;
                overflow: overlay;
            }


            .table__body::-webkit-scrollbar {
                width: 0.5rem;
                height: 0.5rem;
            }

            .table__body::-webkit-scrollbar-thumb {
                border-radius: .5rem;
                background-color: #0004;
                visibility: hidden;
            }

            .table__body:hover::-webkit-scrollbar-thumb {
                visibility: visible;
            }


            table {
                width: 100%;
            }

            td img {
                width: 36px;
                height: 36px;
                margin-right: .5rem;
                border-radius: 50%;

                vertical-align: middle;
            }

            table,
            th,
            td {
                border-collapse: collapse;
                padding: 1rem;
                text-align: left;
            }

            thead th {
                position: sticky;
                top: 0;
                left: 0;
                background-color: #d5d1defe;
                cursor: pointer;
                text-transform: capitalize;
            }

            tbody tr:nth-child(even) {
                background-color: #0000000b;
            }

            tbody tr {
                --delay: .1s;
                transition: .5s ease-in-out var(--delay), background-color 0s;
            }

            tbody tr.hide {
                opacity: 0;
                transform: translateX(100%);
            }

            tbody tr:hover {
                background-color: #fff6 !important;
            }

            tbody tr td,
            tbody tr td p,
            tbody tr td img {
                transition: .2s ease-in-out;
            }

            tbody tr.hide td,
            tbody tr.hide td p {
                padding: 0;
                font: 0 / 0 sans-serif;
                transition: .2s ease-in-out .5s;
            }

            tbody tr.hide td img {
                width: 0;
                height: 0;
                transition: .2s ease-in-out .5s;
            }

            .status {
                padding: .4rem 0;
                border-radius: 2rem;
                text-align: center;
            }

            .status.delivered {
                background-color: #86e49d;
                color: #006b21;
            }

            .status.cancelled {
                background-color: #d893a3;
                color: #b30021;
            }

            .status.pending {
                background-color: #ebc474;
            }

            .status.shipped {
                background-color: #6fcaea;
            }


            @media (max-width: 1000px) {
                td:not(:first-of-type) {
                    min-width: 12.1rem;
                }
            }

            thead th span.icon-arrow {
                display: inline-block;
                width: 1.3rem;
                height: 1.3rem;
                border-radius: 50%;
                border: 1.4px solid transparent;

                text-align: center;
                font-size: 1rem;

                margin-left: .5rem;
                transition: .2s ease-in-out;
            }

            thead th:hover span.icon-arrow {
                border: 1.4px solid #6c00bd;
            }

            thead th:hover {
                color: #6c00bd;
            }

            thead th.active span.icon-arrow {
                background-color: #6c00bd;
                color: #fff;
            }

            thead th.asc span.icon-arrow {
                transform: rotate(180deg);
            }

            thead th.active,
            tbody td.active {
                color: #6c00bd;
            }
        </style>


        <div class="belum_diambil">
            <!-- Table -->
            <main class="table" id="customers_table">
                <div class="table__header">
                    <h1>Customer's Orders</h1>
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
                                <th> Order Date <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Status <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Detail <span class="icon-arrow">&UpArrow;</span></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($list_tugas_beli as $lt)
                            <tr>
                                <td> {{ $loop->iteration }} </td>
                                <td> <img src="a{{ asset('avatar/Jeet Saru.jpg') }}" alt="">{{ $lt->nama_penerima }}</td>
                                <td> {{ $lt->alamat }} </td>
                                <td> {{ $lt->notabeli->created_at }}</td>
                                <td>
                                    <p class="status pending">{{ $lt->status }}</p>
                                </td>
                                <td> <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$loop->iteration}}">
                                        Detail order
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Tugas</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <form method="post" action="/driver/ambilTugas">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary">Ambil Tugas</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
            @endforeach
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
</body>

</html>