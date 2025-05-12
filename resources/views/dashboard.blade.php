@extends('layouts.app')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Home</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page">Home</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->
<!-- [ Main Content ] start -->
<div class="row">
    <div class="row">
        <!-- Total Pemasukan -->
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-2 f-w-400 text-muted">Total Pemasukan</h6>
                    <h4 class="mb-3">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                        <span class="badge bg-light-success border border-success">
                            <i class="ti ti-trending-up"></i>
                            {{ $persenPemasukan > 0 ? $persenPemasukan.'%' : '0%' }}
                        </span>
                    </h4>
                    <p class="mb-0 text-muted text-sm">
                        Pemasukan bulan ini <span class="text-success">Rp {{ number_format($pemasukanBulanIni, 0, ',',
                            '.') }}</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Total Pengeluaran -->
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-2 f-w-400 text-muted">Total Pengeluaran</h6>
                    <h4 class="mb-3">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                        <span class="badge bg-light-danger border border-danger">
                            <i class="ti ti-trending-up"></i>
                            {{ $persenPengeluaran > 0 ? $persenPengeluaran.'%' : '0%' }}
                        </span>
                    </h4>
                    <p class="mb-0 text-muted text-sm">
                        Pengeluaran bulan ini <span class="text-danger">Rp {{ number_format($pengeluaranBulanIni, 0,
                            ',', '.') }}</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Saldo -->
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-2 f-w-400 text-muted">Saldo</h6>
                    <h4 class="mb-3">Rp {{ number_format($saldo, 0, ',', '.') }}
                        <span
                            class="badge bg-light-{{ $saldo > 0 ? 'primary' : 'danger' }} border border-{{ $saldo > 0 ? 'primary' : 'danger' }}">
                            <i class="ti ti-trending-{{ $saldo > 0 ? 'up' : 'down' }}"></i>
                            {{ $persenSaldo > 0 ? $persenSaldo.'%' : '0%' }}
                        </span>
                    </h4>
                    <p class="mb-0 text-muted text-sm">
                        Perubahan saldo <span class="text-{{ $saldo > 0 ? 'primary' : 'danger' }}">Rp {{
                            number_format(abs($saldo - $saldoBulanLalu)), 0, ',', '.' }}</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Total Kategori -->
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-2 f-w-400 text-muted">Total Kategori</h6>
                    <h4 class="mb-3">{{ $totalKategori }}
                        <span class="badge bg-light-info border border-info">
                            <i class="ti ti-tag"></i>
                        </span>
                    </h4>
                    <p class="mb-0 text-muted text-sm">
                        {{ $kategoriPemasukan }} pemasukan, {{ $kategoriPengeluaran }} pengeluaran
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-xl-8">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="mb-0">Statistik Keuangan</h5>
            <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="chart-tab-month-tab" data-bs-toggle="pill"
                        data-bs-target="#chart-tab-month" type="button" role="tab" aria-controls="chart-tab-month"
                        aria-selected="true">Bulanan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="chart-tab-week-tab" data-bs-toggle="pill"
                        data-bs-target="#chart-tab-week" type="button" role="tab" aria-controls="chart-tab-week"
                        aria-selected="false">Mingguan</button>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="tab-content" id="chart-tab-tabContent">
                    <div class="tab-pane fade show active" id="chart-tab-month" role="tabpanel"
                        aria-labelledby="chart-tab-month-tab">
                        <div id="finance-chart-month" style="min-height: 450px;"></div>
                    </div>
                    <div class="tab-pane fade" id="chart-tab-week" role="tabpanel" aria-labelledby="chart-tab-week-tab">
                        <div id="finance-chart-week" style="min-height: 450px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-4">
        <h5 class="mb-3">Income Overview</h5>
        <div class="card">
            <div class="card-body">
                <h6 class="mb-2 f-w-400 text-muted">This Week Statistics</h6>
                <h3 class="mb-3">$7,650</h3>
                <div id="income-overview-chart"></div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-xl-8">
        <h5 class="mb-3">Recent Orders</h5>
        <div class="card tbl-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless mb-0">
                        <thead>
                            <tr>
                                <th>TRACKING NO.</th>
                                <th>PRODUCT NAME</th>
                                <th>TOTAL ORDER</th>
                                <th>STATUS</th>
                                <th class="text-end">TOTAL AMOUNT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="#" class="text-muted">84564564</a></td>
                                <td>Camera Lens</td>
                                <td>40</td>
                                <td><span class="d-flex align-items-center gap-2"><i
                                            class="fas fa-circle text-danger f-10 m-r-5"></i>Rejected</span>
                                </td>
                                <td class="text-end">$40,570</td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-muted">84564564</a></td>
                                <td>Laptop</td>
                                <td>300</td>
                                <td><span class="d-flex align-items-center gap-2"><i
                                            class="fas fa-circle text-warning f-10 m-r-5"></i>Pending</span>
                                </td>
                                <td class="text-end">$180,139</td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-muted">84564564</a></td>
                                <td>Mobile</td>
                                <td>355</td>
                                <td><span class="d-flex align-items-center gap-2"><i
                                            class="fas fa-circle text-success f-10 m-r-5"></i>Approved</span>
                                </td>
                                <td class="text-end">$180,139</td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-muted">84564564</a></td>
                                <td>Camera Lens</td>
                                <td>40</td>
                                <td><span class="d-flex align-items-center gap-2"><i
                                            class="fas fa-circle text-danger f-10 m-r-5"></i>Rejected</span>
                                </td>
                                <td class="text-end">$40,570</td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-muted">84564564</a></td>
                                <td>Laptop</td>
                                <td>300</td>
                                <td><span class="d-flex align-items-center gap-2"><i
                                            class="fas fa-circle text-warning f-10 m-r-5"></i>Pending</span>
                                </td>
                                <td class="text-end">$180,139</td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-muted">84564564</a></td>
                                <td>Mobile</td>
                                <td>355</td>
                                <td><span class="d-flex align-items-center gap-2"><i
                                            class="fas fa-circle text-success f-10 m-r-5"></i>Approved</span>
                                </td>
                                <td class="text-end">$180,139</td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-muted">84564564</a></td>
                                <td>Camera Lens</td>
                                <td>40</td>
                                <td><span class="d-flex align-items-center gap-2"><i
                                            class="fas fa-circle text-danger f-10 m-r-5"></i>Rejected</span>
                                </td>
                                <td class="text-end">$40,570</td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-muted">84564564</a></td>
                                <td>Laptop</td>
                                <td>300</td>
                                <td><span class="d-flex align-items-center gap-2"><i
                                            class="fas fa-circle text-warning f-10 m-r-5"></i>Pending</span>
                                </td>
                                <td class="text-end">$180,139</td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-muted">84564564</a></td>
                                <td>Mobile</td>
                                <td>355</td>
                                <td><span class="d-flex align-items-center gap-2"><i
                                            class="fas fa-circle text-success f-10 m-r-5"></i>Approved</span>
                                </td>
                                <td class="text-end">$180,139</td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-muted">84564564</a></td>
                                <td>Mobile</td>
                                <td>355</td>
                                <td><span class="d-flex align-items-center gap-2"><i
                                            class="fas fa-circle text-success f-10 m-r-5"></i>Approved</span>
                                </td>
                                <td class="text-end">$180,139</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-4">
        <h5 class="mb-3">Analytics Report</h5>
        <div class="card">
            <div class="list-group list-group-flush">
                <a href="#"
                    class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">Company
                    Finance Growth<span class="h5 mb-0">+45.14%</span></a>
                <a href="#"
                    class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">Company
                    Expenses Ratio<span class="h5 mb-0">0.58%</span></a>
                <a href="#"
                    class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">Business
                    Risk Cases<span class="h5 mb-0">Low</span></a>
            </div>
            <div class="card-body px-2">
                <div id="analytics-report-chart"></div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-xl-8">
        <h5 class="mb-3">Sales Report</h5>
        <div class="card">
            <div class="card-body">
                <h6 class="mb-2 f-w-400 text-muted">This Week Statistics</h6>
                <h3 class="mb-0">$7,650</h3>
                <div id="sales-report-chart"></div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-4">
        <h5 class="mb-3">Transaction History</h5>
        <div class="card">
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s rounded-circle text-success bg-light-success">
                                <i class="ti ti-gift f-18"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">Order #002434</h6>
                            <p class="mb-0 text-muted">Today, 2:00 AM</P>
                        </div>
                        <div class="flex-shrink-0 text-end">
                            <h6 class="mb-1">+ $1,430</h6>
                            <p class="mb-0 text-muted">78%</P>
                        </div>
                    </div>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s rounded-circle text-primary bg-light-primary">
                                <i class="ti ti-message-circle f-18"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">Order #984947</h6>
                            <p class="mb-0 text-muted">5 August, 1:45 PM</P>
                        </div>
                        <div class="flex-shrink-0 text-end">
                            <h6 class="mb-1">- $302</h6>
                            <p class="mb-0 text-muted">8%</P>
                        </div>
                    </div>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s rounded-circle text-danger bg-light-danger">
                                <i class="ti ti-settings f-18"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">Order #988784</h6>
                            <p class="mb-0 text-muted">7 hours ago</P>
                        </div>
                        <div class="flex-shrink-0 text-end">
                            <h6 class="mb-1">- $682</h6>
                            <p class="mb-0 text-muted">16%</P>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Monthly Data:', @json($monthlyData));
        console.log('Weekly Data:', @json($weeklyData));
        if (!document.querySelector('#finance-chart-month')) {
            console.error('Elemen #finance-chart-month tidak ditemukan!');
            return;
        }

        if (!document.querySelector('#finance-chart-week')) {
            console.error('Elemen #finance-chart-week tidak ditemukan!');
            return;
        }
        var monthlyData = @json($monthlyData);
        var weeklyData = @json($weeklyData);
        var monthlyOptions = {
            chart: {
                type: 'area',
                height: 450,
                toolbar: { show: false },
                animations: { enabled: true }
            },
            series: [
                { name: 'Pemasukan', data: monthlyData.income || [] },
                { name: 'Pengeluaran', data: monthlyData.expense || [] }
            ],
            colors: ['#1890ff', '#13c2c2'],
            xaxis: { categories: monthlyData.months || [] },
            yaxis: {
                labels: {
                    formatter: function(val) { return 'Rp' + val.toLocaleString('id-ID'); }
                }
            },
            tooltip: {
                y: { formatter: function(val) { return 'Rp' + val.toLocaleString('id-ID'); } }
            },
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 2 }
        };
        var monthlyChart = new ApexCharts(
            document.querySelector('#finance-chart-month'),
            monthlyOptions
        );
        monthlyChart.render();
        var weeklyOptions = {
            chart: {
                type: 'area',
                height: 450,
                toolbar: { show: false },
                animations: { enabled: true }
            },
            series: [
                { name: 'Pemasukan', data: weeklyData.income || [] },
                { name: 'Pengeluaran', data: weeklyData.expense || [] }
            ],
            colors: ['#1890ff', '#13c2c2'],
            xaxis: { categories: weeklyData.weeks || [] },
            yaxis: {
                labels: {
                    formatter: function(val) { return 'Rp' + val.toLocaleString('id-ID'); }
                }
            },
            tooltip: {
                y: { formatter: function(val) { return 'Rp' + val.toLocaleString('id-ID'); } }
            },
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 2 }
        };
        var weeklyChart = new ApexCharts(
            document.querySelector('#finance-chart-week'),
            weeklyOptions
        );
        weeklyChart.render();
        document.querySelectorAll('[data-bs-toggle="pill"]').forEach(tab => {
            tab.addEventListener('shown.bs.tab', function(event) {
                setTimeout(() => {
                    monthlyChart.update();
                    weeklyChart.update();
                }, 100);
            });
        });
    });
</script>
@endsection
