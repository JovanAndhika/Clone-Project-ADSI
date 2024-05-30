@extends('layouts.customer')

@section('content')
    <h1 class="text-center">Customer View</h1>
    @include('components.alert')
    <a class="btn btn-primary" href="{{ route('customer.beli.index') }}" role="button">Beli</a>

    @if($notaBeli->count() > 0)
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
                                <td>@if($item->status) Lunas @else Belum Lunas @endif</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    @endif
@endsection