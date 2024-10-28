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
                        LAPORAN STOK BARANG<br />
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
                <th>No</th>
                <th>Nama Barang</th>
                <th>Deskripsi</th>
                <th>Jenis Barang</th>
                <th>Merk Barang</th>
                <th>Opsi Barang</th>
                <th>Stok Barang</th>
                <th>Berat Barang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $index => $barang)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $barang->nama }}</td>
                    <td>{{ $barang->deskripsi }}</td>
                    <td>{{ $barang->jenisBarang->nama }}</td>
                    <td>{{ $barang->merkBarang->nama }} <br>
                        @if (isset($barang->merkBarang->logo))
                        <div class="mb-2">
                            <img src="{{ asset($barang->merkBarang->logo) }}" alt="logo" class="img-thumbnail"
                            width="50px" height="auto">
                        </div>
                        @endif
                    </td>
                  
                    <td>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex flex-column">
                                @if ($barang->opsi_barang && is_array($barang->opsi_barang))
                                    @foreach ($barang->opsi_barang as $item)
                                        <span class="badge bg-success mb-1 mt-1">{{ $item['opsi'] }}</span>
                                        <div>
                                            @foreach ($item['subopsi'] as $subopt)
                                                <span class="badge bg-secondary me-1">{{ $subopt }}</span>
                                            @endforeach
                                        </div>
                                    @endforeach
                                @else
                                    <span class="badge bg-danger">Tidak ada opsi</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td style="color: #ff1616; font-weight:900">
                        {{ $barang->stok }}
                    </td>
                    <td>
                        {{ $barang->berat }} Gram
                    </td>
                   
                </tr>

          
            @endforeach
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>
