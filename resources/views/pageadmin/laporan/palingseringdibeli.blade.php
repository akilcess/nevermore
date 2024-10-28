<!DOCTYPE html>
<html>

<head>
    <title>Laporan Barang Paling Sering Dibeli</title>
    <style>
        @media print {
            body { padding: 20px; font-family: Arial, sans-serif; }
            #table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
            #table th, #table td { border: 1px solid #000; padding: 8px; text-align: left; }
            #table th { background-color: #f2f2f2; }
        }
        #table { border: 1px solid #ccc; border-collapse: collapse; margin: 0 auto; width: 100%; }
        #table th, #table td { border: 1px solid #ccc; padding: 10px; }
        #table th { background-color: #f2f2f2; font-weight: bold; }
        #table td { text-align: left; }
    </style>
</head>

<body>
    <table style="text-align:center; width:100%">
        <tbody>
            <tr>
                <td>
                    <h4>LAPORAN BARANG PALING SERING DIBELI<br>NEVERMORE</h4>
                    <p>Alamat: Sulawesi Tengah, Palu, Kode Pos: 29295, No. Telp: 6692232</p>
                </td>
            </tr>
        </tbody>
    </table>

    <div style="background:#000; height:4px; width:100%"></div>
    <div style="background:#000; height:2px; margin-top:2px; width:100%"></div>

    <table id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Deskripsi</th>
                <th>Jenis Barang</th>
                <th>Merk Barang</th>
                <th>Terjual</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $index => $barang)
                @if ($barang->total_sold > 0)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $barang->nama }}</td>
                        <td>{{ $barang->deskripsi }}</td>
                        <td>{{ $barang->jenisBarang->nama ?? 'N/A' }}</td>
                        <td>{{ $barang->merkBarang->nama ?? 'N/A' }}</td>
                        <td>{{ $barang->total_sold }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <script>
        window.print();
    </script>
</body>

</html>
