<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Total semua waktu
        $totalPemasukan = Transaction::where('user_id', $userId)
            ->where('type', 'pemasukan')
            ->sum('amount');

        $totalPengeluaran = Transaction::where('user_id', $userId)
            ->where('type', 'pengeluaran')
            ->sum('amount');

        $saldo = $totalPemasukan - $totalPengeluaran;

        // Data bulan ini
        $pemasukanBulanIni = Transaction::where('user_id', $userId)
            ->where('type', 'pemasukan')
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->sum('amount');

        $pengeluaranBulanIni = Transaction::where('user_id', $userId)
            ->where('type', 'pengeluaran')
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->sum('amount');

        // Data bulan lalu
        $pemasukanBulanLalu = Transaction::where('user_id', $userId)
            ->where('type', 'pemasukan')
            ->whereMonth('date', now()->subMonth()->month)
            ->whereYear('date', now()->subMonth()->year)
            ->sum('amount');

        $pengeluaranBulanLalu = Transaction::where('user_id', $userId)
            ->where('type', 'pengeluaran')
            ->whereMonth('date', now()->subMonth()->month)
            ->whereYear('date', now()->subMonth()->year)
            ->sum('amount');

        // Persentase perubahan
        $persenPemasukan = $pemasukanBulanLalu > 0 ?
            round(($pemasukanBulanIni - $pemasukanBulanLalu) / $pemasukanBulanLalu * 100, 1) : 0;

        $persenPengeluaran = $pengeluaranBulanLalu > 0 ?
            round(($pengeluaranBulanIni - $pengeluaranBulanLalu) / $pengeluaranBulanLalu * 100, 1) : 0;

        $saldoBulanLalu = ($pemasukanBulanLalu - $pengeluaranBulanLalu);
        $persenSaldo = $saldoBulanLalu != 0 ?
            round(($saldo - $saldoBulanLalu) / abs($saldoBulanLalu) * 100, 1) : 0;

        // Data kategori
        $totalKategori = Category::count();
        $kategoriPemasukan = Category::where('type', 'pemasukan')->count();
        $kategoriPengeluaran = Category::where('type', 'pengeluaran')->count();

        // Data bulanan untuk chart
        $currentYear = now()->year;
        $monthlyData = [
            'income' => [],
            'expense' => [],
            'months' => []
        ];

        for ($i = 1; $i <= 12; $i++) {
            $date = Carbon::create($currentYear, $i, 1);
            $monthlyData['months'][] = $date->translatedFormat('M');
            $monthlyData['income'][] = (float) Transaction::where('user_id', $userId)
                ->where('type', 'pemasukan')
                ->whereMonth('date', $i)
                ->whereYear('date', $currentYear)
                ->sum('amount');
            $monthlyData['expense'][] = (float) Transaction::where('user_id', $userId)
                ->where('type', 'pengeluaran')
                ->whereMonth('date', $i)
                ->whereYear('date', $currentYear)
                ->sum('amount');
        }

        // Data mingguan untuk chart
        $weeklyData = [
            'income' => [],
            'expense' => [],
            'weeks' => []
        ];
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();
        $interval = $startOfMonth->diffInDays($endOfMonth) / 4;

        for ($i = 0; $i < 4; $i++) {
            $startWeek = $i == 0 ? $startOfMonth : $startOfMonth->copy()->addDays($i * $interval);
            $endWeek = $i == 3 ? $endOfMonth : $startOfMonth->copy()->addDays(($i + 1) * $interval - 1);
            $weeklyData['weeks'][] = 'Minggu ' . ($i + 1);
            $weeklyData['income'][] = (float) Transaction::where('user_id', $userId)
                ->where('type', 'pemasukan')
                ->whereBetween('date', [$startWeek, $endWeek])
                ->sum('amount');
            $weeklyData['expense'][] = (float) Transaction::where('user_id', $userId)
                ->where('type', 'pengeluaran')
                ->whereBetween('date', [$startWeek, $endWeek])
                ->sum('amount');
        }

        // Data harian untuk chart pengeluaran
        $dailyExpensesData = [];
        $today = Carbon::today();
        for ($i = 6; $i >= 0; $i--) {
            $date = $today->copy()->subDays($i);
            $dayName = $date->translatedFormat('D');
            $formattedDate = $date->format('d M');
            $amount = (float) Transaction::where('user_id', $userId)
                ->where('type', 'pengeluaran')
                ->whereDate('date', $date->format('Y-m-d'))
                ->sum('amount');
            $dailyExpensesData[] = [
                'day' => $dayName,
                'date' => $formattedDate,
                'amount' => $amount,
                'full_date' => $date->format('Y-m-d')
            ];
        }

        $weeklyTotalExpense = array_sum(array_column($dailyExpensesData, 'amount'));

        return view('dashboard', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'saldo',
            'pemasukanBulanIni',
            'pengeluaranBulanIni',
            'persenPemasukan',
            'persenPengeluaran',
            'persenSaldo',
            'saldoBulanLalu',
            'totalKategori',
            'kategoriPemasukan',
            'kategoriPengeluaran',
            'monthlyData',
            'weeklyData',
            'dailyExpensesData',
            'weeklyTotalExpense'
        ));
    }
}
