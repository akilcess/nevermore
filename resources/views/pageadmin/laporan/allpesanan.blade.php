<!DOCTYPE html>
<html>

<head>
    <title>Laporan</title>
    <style>
        @media print {

            /* CSS untuk mengatur tampilan saat dicetak */
            body {
                padding: 20px;
                font-family: Arial, sans-serif;
            }

            #table {
                border-collapse: collapse;
                width: 100%;
                margin-bottom: 20px;
            }

            #table th,
            #table td {
                border: 1px solid #000;
                padding: 8px;
                text-align: left;
            }

            #table th {
                background-color: #f2f2f2;
            }
        }

        /* CSS tambahan untuk desain tabel */
        #table {
            border: 1px solid #ccc;
            border-collapse: collapse;
            margin: 0 auto;
            width: 100%;
        }

        #table th,
        #table td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        #table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        #table td {
            text-align: left;
        }
    </style>
</head>

<body>
    <table class="table table-borderless text-center"
        style="border-width:0px!important; border:none; text-align:center; width:100%">
        <tbody>
            <tr>
                <td>
                    <h4>
                        LAPORAN PENJUALAN KESELURUHAN<br />
                        NEVERMORE</h4>

                    <p style="margin-left:0px; margin-right:0px">Alamat : Sulawesi Tengah,Palu, Kode Pos : 29295, No.
                        Telp :
                        6692232</p>
                </td>
            </tr>
        </tbody>
    </table>

    <div
        style="background:#000000; cursor:text; height:4px; margin-bottom:0px; margin-left:0px; margin-right:0px; margin-top:0px; width:100%">
        &nbsp;</div>

    <div style="background:#000000; cursor:text; height:2px; margin-top:2px; width:100%">&nbsp;</div>

    <table id="table">
        <thead>
            <tr>
                <th>Pesanan</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allPesananData as $checkout)
                <tr>
                    <td>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Barang</th>
                                    <th>Opsi Barang</th>
                                    <th>Jumlah</th>
                                    <th>Detail Customer</th>
                                    <th>Gambar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($checkout['items'] as $item)
                                    <tr>
                                        <td>{{ $item['nama_barang'] }}</td>
                                        <td>
                                            <p class="d-block">
                                                @foreach ($item['opsi_barang'] as $key => $value)
                                                    {{ $key }}: {{ $value }}<br>
                                                @endforeach
                                            </p>
                                        </td>
                                        <td class="card-text">{{ $item['quantity'] }}</td>
                                        <td>
                                            @if ($checkout['user_details'])
                                                Nama: {{ $checkout['user_details']['nama'] }}<br>
                                                Alamat: {{ $checkout['user_details']['city'] ?? 'Unknown' }},
                                                {{ $checkout['user_details']['province'] ?? 'Unknown' }},
                                                {{ $checkout['user_details']['alamat'] }}<br>
                                                Telepon: {{ $checkout['user_details']['telepon'] }}<br>
                                            @else
                                                <p>User details not available.</p>
                                            @endif
                                        </td>


                                        <td class="card-text"><img src="{{ asset($item['gambar_barang']) }}"
                                                width="100px" alt="" srcset="">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                    <td> Rp{{ number_format($checkout['total_harga'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>
