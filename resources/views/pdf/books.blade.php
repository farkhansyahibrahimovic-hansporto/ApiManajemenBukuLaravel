<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
        }

        h1 {
            text-align: center;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            font-size: 11px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #333;
            padding: 6px 8px;
            vertical-align: top;
        }

        table th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 20px;
            font-size: 10px;
            text-align: right;
        }
    </style>
</head>
<body>

    <h1>Laporan Data Buku</h1>
    <div class="subtitle">
        Dicetak pada {{ now()->format('d-m-Y H:i') }}
    </div>

    <table>
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="18%">Judul</th>
                <th width="14%">Penulis</th>
                <th width="14%">Penerbit</th>
                <th width="8%">Tahun</th>
                <th width="6%">Stok</th>
                <th width="10%">Kategori</th>
                <th width="26%">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($books as $book)
                <tr>
                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td>{{ $book->judul }}</td>
                    <td>{{ $book->penulis }}</td>
                    <td>{{ $book->penerbit ?? '-' }}</td>
                    <td class="text-center">{{ $book->tahun_terbit }}</td>
                    <td class="text-center">{{ $book->stok }}</td>
                    <td>{{ $book->category->nama ?? '-' }}</td>
                    <td>{{ $book->deskripsi ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">
                        Data buku tidak tersedia
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Total Buku: {{ $books->count() }}
    </div>

</body>
</html>
