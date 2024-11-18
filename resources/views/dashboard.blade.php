@extends('layout.admin')

@section('content')
    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <div class="container-fluid">
            <!-- Row 1 -->
            <div class="row">
                <!-- BOOKS -->
                <div class="col-lg-3 col-sm-6">
                    <a href="/">
                        <div class="card">
                            <div class="card-body">
                                <h2>
                                    <i class="ti ti-book"></i>
                                </h2>
                                <h3>
                                    Penyewa
                                </h3>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- BOOK STOCK -->
                <div class="col-lg-3 col-sm-6">
                    <a href="/">
                        <div class="card">
                            <div class="card-body">
                                <h2>
                                    <i class="ti ti-database"></i>
                                </h2>
                                <h3>
                                    Total Rumah
                                </h3>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- RACKS -->
                <div class="col-lg-3 col-6">
                    <a href="/">
                        <div class="card">
                            <div class="card-body">
                                <h2>
                                    <i class="ti ti-columns"></i>
                                </h2>
                                <h3>
                                    Pengajuan Sewa
                                </h3>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- CATEGORIES -->
                <div class="col-lg-3 col-6">
                    <a href="/">
                        <div class="card">
                            <div class="card-body">
                                <h2>
                                    <i class="ti ti-category-2"></i>
                                </h2>
                                <h3>
                                    Total Surat
                                </h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- REPORT TODAY -->
            {{-- <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h3 class="card-title"><b>Laporan Hari Ini</b></h3>
                            {{-- {{ $dateNow->format('d F Y') }} --}}
            {{-- </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6 col-md-3">
                                    <h4 class="text-success"><b>Surat Masuk</b></h4>
                                    <h3> </h3>
                                </div>
                                <div class="col-6 col-md-3">
                                    <h4 class="text-info"><b>Surat Keluar</b></h4>
                                    <h3></h3>
                                </div>
                                <div class="col-6 col-md-3">
                                    <h4 class="text-info"><b>Disposisi</b></h4>
                                    <h3></h3>
                                </div>
                                <div class="col-6 col-md-3">
                                    <h4 class="text-danger"><b>Surat Klasifikasi</b></h4>
                                    <h3></h3>
                                </div>
                            </div>
                            <div class="row text-center mt-4">
                                <div class="col-6 col-md-3">
                                    <h4 class="text-warning"><b>Jumlah Semua Surat</b></h4>
                                    <h3>/</h3>
                                </div>
                                <div class="col-6 col-md-3">
                                    <h4 class="text-dark"><b>Permohonan Surat</b></h4>
                                    <h3>/</h3>
                                </div>
                                <div class="col-6 col-md-3">
                                    <h4 class="text-primary"><b>Surat Ditolak</b></h4>
                                    <h3>/</h3>
                                </div>
                                <div class="col-6 col-md-3">
                                    <h4 class="text-secondary"><b>Surat Approve</b></h4>
                                    <h3>/</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- Grafik Peminjaman Buku -->
            {{-- <div class="row mt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><b>Peminjaman Buku dalam 3 Tahun Terakhir</b></h3>
                        </div>
                        <div class="card-body">
                            <canvas id="bookLoansChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const ctx = document.getElementById('bookLoansChart').getContext('2d');
                const bookLoansChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['2021', '2022', '2023', '2024'], // Ganti dengan tahun yang sesuai
                        datasets: [{
                            label: 'Peminjaman Buku',
                            data: [{{ $loans2021 }}, {{ $loans2022 }}, {{ $loans2023 }}, {{ $loans2024 }}], // Ganti dengan data aktual
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script> --}}
            <!-- SweetAlert CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <script>
                @if (Session::has('toast_success'))
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '{{ Session::get('toast_success') }}',
                        showConfirmButton: false,
                        timer: 3000,
                        toast: true,
                        customClass: {
                            popup: 'colored-toast',
                        }
                    });
                @endif

                @if (Session::has('toast_error'))
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: '{{ Session::get('toast_error') }}',
                        showConfirmButton: false,
                        timer: 3000,
                        toast: true,
                        customClass: {
                            popup: 'colored-toast',
                        }
                    });
                @endif
            </script>
        </div>
    </div>
@endsection
