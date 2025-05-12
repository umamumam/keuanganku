<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('category')->latest()->get();
        $categories = Category::all();
        return view('transactions.index', compact('transactions', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:pemasukan,pengeluaran',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string'
        ]);

        Transaction::create($request->all());

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:pemasukan,pengeluaran',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string'
        ]);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }

    public function report(Request $request)
    {
        $categories = Category::all();

        // Default tanggal (bulan ini)
        $startDate = $request->has('start_date')
            ? Carbon::parse($request->start_date)
            : now()->startOfMonth();

        $endDate = $request->has('end_date')
            ? Carbon::parse($request->end_date)
            : now()->endOfMonth();

        // Query transaksi dengan filter
        $query = Transaction::with('category')
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'desc');

        // Filter kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter jenis transaksi
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $transactions = $query->get();

        // Hitung summary
        $summary = [
            'income' => $transactions->where('type', 'pemasukan')->sum('amount'),
            'expense' => $transactions->where('type', 'pengeluaran')->sum('amount'),
            'balance' => $transactions->where('type', 'pemasukan')->sum('amount') -
                $transactions->where('type', 'pengeluaran')->sum('amount')
        ];

        $period = $startDate->translatedFormat('d F Y') . ' - ' . $endDate->translatedFormat('d F Y');

        // Jika request export PDF
        if ($request->has('export')) {
            $pdf = Pdf::loadView('transactions.report-pdf', compact(
                'transactions',
                'summary',
                'period'
            ))->setPaper('a4', 'potrait');

            return $pdf->stream('laporan-transaksi-' . $startDate->format('Y-m-d') . '-to-' . $endDate->format('Y-m-d') . '.pdf');
        }

        // Jika request normal (view HTML)
        return view('transactions.report', compact(
            'transactions',
            'categories',
            'startDate',
            'endDate',
            'summary'
        ));
    }

    public function exportPdf(Request $request)
    {
        // Default tanggal (bulan ini)
        $startDate = $request->has('start_date')
            ? Carbon::parse($request->start_date)
            : now()->startOfMonth();

        $endDate = $request->has('end_date')
            ? Carbon::parse($request->end_date)
            : now()->endOfMonth();

        // Query transaksi dengan filter
        $query = Transaction::with('category')
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'desc');

        // Filter kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter jenis transaksi
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $transactions = $query->get();

        // Hitung summary
        $summary = [
            'income' => $transactions->where('type', 'pemasukan')->sum('amount'),
            'expense' => $transactions->where('type', 'pengeluaran')->sum('amount'),
            'balance' => $transactions->where('type', 'pemasukan')->sum('amount') -
                $transactions->where('type', 'pengeluaran')->sum('amount')
        ];

        $period = $startDate->translatedFormat('d F Y') . ' - ' . $endDate->translatedFormat('d F Y');

        $pdf = Pdf::loadView('transactions.report-pdf', compact(
            'transactions',
            'summary',
            'period'
        ));

        return $pdf->download('laporan-transaksi-' . $startDate->format('Y-m-d') . '-to-' . $endDate->format('Y-m-d') . '.pdf');
    }
}
