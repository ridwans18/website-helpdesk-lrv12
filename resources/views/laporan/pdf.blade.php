<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Keluhan</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
            table-layout: fixed;
            word-wrap: break-word;
        }

        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <h2>Laporan Keluhan</h2>
    <p>Tanggal: {{ $request->tanggal_awal }} sampai {{ $request->tanggal_akhir }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>NIK</th>
                <th>Nama Pelapor</th>
                <th>Keluhan</th>
                <th>Jabatan</th>
                <th>Kategori</th>
                <th>Teknisi</th>
                <th>Nota Dinas</th>
                <th>Satuan Kerja</th>
                <th>Lantai</th>
                <th>Tanggal Lapor</th>
                <th>Tenggat Waktu</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nip }}</td>
                <td>{{ $item->nik }}</td>
                <td>{{ $item->nama_pelapor }}</td>
                <td>{{ $item->keluhan }}</td>
                <td>{{ $item->jabatan }}</td>
                <td>{{ $item->kategori }}</td>
                <td>{{ $item->teknisi }}</td>
                <td>{{ $item->notadinas }}</td>
                <td>{{ $item->satuankerja }}</td>
                <td>{{ $item->lantai }}</td>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->deadline)->format('d-m-Y') }}</td>
                <td>
                    @switch($item->status)
                        @case(1) Open @break
                        @case(2) Diproses @break
                        @case(3) Close @break
                        @case(4) Overdue @break
                        @default Tidak Diketahui
                    @endswitch
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
