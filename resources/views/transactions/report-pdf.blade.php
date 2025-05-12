<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .header h2 {
            margin: 0;
            padding: 0;
        }

        .header p {
            margin: 5px 0;
            color: #666;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }

        .table th {
            background-color: #f2f2f2;
            text-align: left;
            padding: 8px;
            border: 1px solid #ddd;
            font-weight: bold;
        }

        .table td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .text-right {
            text-align: right;
        }

        .text-success {
            color: #28a745;
        }

        .text-danger {
            color: #dc3545;
        }

        .footer {
            margin-top: 15px;
            font-size: 11px;
            text-align: right;
            color: #666;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #666;
            font-style: italic;
        }

        .summary-row {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Laporan Transaksi Keuangan</h2>
        <p>Periode: {{ $period }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th width="10%">Tanggal</th>
                <th width="20%">Kategori</th>
                <th width="15%">Jenis</th>
                <th width="25%" class="text-right">Jumlah</th>
                <th width="30%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $transaction)
            <tr>
                <td>{{ $transaction->date->format('d/m/Y') }}</td>
                <td>{{ $transaction->category->name }}</td>
                <td>{{ ucfirst($transaction->type) }}</td>
                <td class="text-right {{ $transaction->type === 'pemasukan' ? 'text-success' : 'text-danger' }}">
                    Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                </td>
                <td>{{ $transaction->description ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="no-data">Tidak ada data transaksi pada periode ini</td>
            </tr>
            @endforelse

            <!-- Baris Ringkasan -->
            <tr class="summary-row">
                <td colspan="3"><strong>Total</strong></td>
                <td class="text-right text-success">Pemasukan Rp {{ number_format($summary['income'], 0, ',', '.') }}</td>
                <td class="text-right text-danger">Pengeluaran Rp {{ number_format($summary['expense'], 0, ',', '.') }}</td>
            </tr>
            <tr class="summary-row">
                <td colspan="4"><strong>Saldo</strong></td>
                <td class="text-right {{ $summary['balance'] >= 0 ? 'text-success' : 'text-danger' }}">
                    Rp {{ number_format($summary['balance'], 0, ',', '.') }}
                </td>
                {{-- <td></td> --}}
            </tr>
        </tbody>
    </table>
    <br>
    <hr>
    <div class="footer">
        Dicetak pada: {{ now()->translatedFormat('d F Y H:i:s') }}
    </div>
</body>

</html>
