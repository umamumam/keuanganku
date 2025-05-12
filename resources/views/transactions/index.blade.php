@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Transaksi</h4>
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">
                    Tambah Transaksi
                </button>
            </div>
            @if(session('success'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil!",
                        text: "{{ session('success') }}",
                        showConfirmButton: false,
                        timer: 3000
                    });
                });
            </script>
            @endif
            <div class="card-body" style="overflow-x:auto;">
                <table id="res-config" class="display table table-striped table-hover dt-responsive nowrap"
                    style="width: 100%">
                    <thead class="table-primary">
                        <tr>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
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
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $transaction->id }}">
                                    <i class="fa fa-pencil-alt"></i>
                                    <span class="d-none d-sm-inline"> Edit</span>
                                </button>

                                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST"
                                    style="display:inline;" class="delete-form">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-button" data-id="{{ $transaction->id }}">
                                        <i class="fa fa-trash-alt"></i>
                                        <span class="d-none d-sm-inline"> Hapus</span>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $transaction->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>Edit Transaksi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-2">
                                                <label>Tanggal</label>
                                                <input type="date" name="date" class="form-control"
                                                    value="{{ $transaction->date->format('Y-m-d') }}" required>
                                            </div>
                                            <div class="mb-2">
                                                <label>Kategori</label>
                                                <select name="category_id" class="form-control" required>
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $transaction->category_id ==
                                                        $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-2">
                                                <label>Jenis</label>
                                                <select name="type" class="form-control" required>
                                                    <option value="pemasukan" {{ $transaction->type === 'pemasukan' ?
                                                        'selected' : '' }}>Pemasukan</option>
                                                    <option value="pengeluaran" {{ $transaction->type === 'pengeluaran'
                                                        ? 'selected' : '' }}>Pengeluaran</option>
                                                </select>
                                            </div>
                                            <div class="mb-2">
                                                <label>Jumlah (Rp)</label>
                                                <input type="number" name="amount" class="form-control"
                                                    value="{{ $transaction->amount }}" required>
                                            </div>
                                            <div class="mb-2">
                                                <label>Keterangan</label>
                                                <textarea name="description"
                                                    class="form-control">{{ $transaction->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tambah Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Tanggal</label>
                        <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-2">
                        <label>Kategori</label>
                        <select name="category_id" class="form-control" required>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Jenis</label>
                        <select name="type" class="form-control" required>
                            <option value="pemasukan">Pemasukan</option>
                            <option value="pengeluaran">Pengeluaran</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Jumlah (Rp)</label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Keterangan</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // SweetAlert delete confirmation
        document.querySelectorAll('.delete-button').forEach(function(button) {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const form = this.closest('form');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: 'Data transaksi ini akan dihapus permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection
