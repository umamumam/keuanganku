@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Laporan Transaksi</h4>
            <a href="{{ route('transactions.index') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('transactions.report') }}" method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <label>Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control"
                            value="{{ request('start_date') ?? now()->startOfMonth()->format('Y-m-d') }}">
                    </div>
                    <div class="col-md-3">
                        <label>Tanggal Akhir</label>
                        <input type="date" name="end_date" class="form-control"
                            value="{{ request('end_date') ?? now()->endOfMonth()->format('Y-m-d') }}">
                    </div>
                    <div class="col-md-3">
                        <label>Kategori</label>
                        <select name="category_id" class="form-control">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id')==$category->id ? 'selected' :
                                '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Jenis</label>
                        <select name="type" class="form-control">
                            <option value="">Semua Jenis</option>
                            <option value="pemasukan" {{ request('type')=='pemasukan' ? 'selected' : '' }}>Pemasukan
                            </option>
                            <option value="pengeluaran" {{ request('type')=='pengeluaran' ? 'selected' : '' }}>
                                Pengeluaran</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <a href="{{ route('transactions.report', array_merge(request()->query(), ['export' => 1])) }}"
                            class="btn btn-danger" target="_blank" onclick="this.blur();">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </a>
                    </div>
                </div>
            </form>

            <div class="mt-4">
                <div class="alert alert-info">
                    <strong>Periode:</strong>
                    {{ $startDate->translatedFormat('d F Y') }} - {{ $endDate->translatedFormat('d F Y') }}
                    <span class="float-end">
                        <strong>Saldo:</strong>
                        <span class="{{ $summary['balance'] >= 0 ? 'text-success' : 'text-danger' }}">
                            Rp {{ number_format($summary['balance'], 0, ',', '.') }}
                        </span>
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Jenis</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->date->format('d/m/Y') }}</td>
                                <td>{{ $transaction->category->name }}</td>
                                <td>
                                    <span
                                        class="badge {{ $transaction->type === 'pemasukan' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($transaction->type) }}
                                    </span>
                                </td>
                                <td class="{{ $transaction->type === 'pemasukan' ? 'text-success' : 'text-danger' }}">
                                    Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                </td>
                                <td>{{ $transaction->description ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data transaksi</td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr class="table-active">
                                <th colspan="3">Total</th>
                                <th class="text-success">Pemasukan: Rp {{ number_format($summary['income'], 0, ',', '.')
                                    }}</th>
                                <th class="text-danger">Pengeluaran: Rp {{ number_format($summary['expense'], 0, ',',
                                    '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
