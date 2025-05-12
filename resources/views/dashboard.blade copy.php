@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <!-- Card Saldo -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500">Saldo Bulan Ini</h3>
        <p class="text-2xl font-bold">{{ number_format($saldo, 0, ',', '.') }}</p>
    </div>
    <!-- Card Pemasukan -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500">Pemasukan</h3>
        <p class="text-2xl font-bold text-green-500">{{ number_format($totalPemasukan, 0, ',', '.') }}</p>
    </div>
    <!-- Card Pengeluaran -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500">Pengeluaran</h3>
        <p class="text-2xl font-bold text-red-500">{{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
    </div>
</div>

<!-- Grafik -->
<div class="bg-white p-6 rounded-lg shadow mb-6">
    <canvas id="chart"></canvas>
</div>

<!-- Daftar Transaksi Terakhir -->
<div class="bg-white p-6 rounded-lg shadow">
    <h3 class="text-lg font-semibold mb-4">Transaksi Terakhir</h3>
    <a href="{{ route('transactions.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Transaksi</a>
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="text-left">Tanggal</th>
                    <th class="text-left">Kategori</th>
                    <th class="text-left">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->date->format('d M Y') }}</td>
                    <td>{{ $transaction->category->name }}</td>
                    <td class="{{ $transaction->type === 'pemasukan' ? 'text-green-500' : 'text-red-500' }}">
                        {{ number_format($transaction->amount, 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    // Grafik dengan Chart.js
    const ctx = document.getElementById('chart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pemasukan', 'Pengeluaran'],
            datasets: [{
                label: 'Jumlah',
                data: [{{ $totalPemasukan }}, {{ $totalPengeluaran }}],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
