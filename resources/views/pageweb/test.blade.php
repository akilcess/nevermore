@extends('template-web.layout')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Checkout Data</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Barang ID</th>
                    <th>Quantity</th>
                    <th>Opsi Barang</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($checkoutData as $data)
                    <tr>
                        <td>{{ $data['barang_id'] }}</td>
                        <td>{{ $data['quantity'] }}</td>
                        <td>{{ $data['opsi_barang'] }}</td>
                        <td>{{ $data['total_harga'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
