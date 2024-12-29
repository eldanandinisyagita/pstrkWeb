@extends('layout.navbar_admin')

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="../assets/css/style.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</head>
<body>
    <main id="main" class="main">
        <div class="container">
            <div class="row">

                <!-- Kolom pertama -->
                <div class="col-8">
                    <div class="row">

                        <!-- slide bar -->
                        <div class="col-12 mb-2 border-box" style="height: 50vh; position: relative;">
                            <div id="kontenCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                                <div class="carousel-inner">
                                    @foreach($photos as $index => $konten)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img src="{{ url('/storage/foto/'.$konten->lampiran) }}" class="d-block w-100 search-img" alt="Gambar Konten" style="height: 80%; object-fit: cover;">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                        <!-- card chart -->
                        <div class="col-12 border-box" style="height: 50vh; display: flex; align-items: flex-start; justify-content: center;">
                            <div class="row w-100 chart-card">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header" style="">
                                            <h5 class="header-title">Data Prestasi PSTRK 2024</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart1">
                                                {!! $chart1->container() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header" style="">
                                            <h5 class="header-title">Data Kegiatan PSTRK 2024</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart2">
                                                {!! $chart2->container() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom kedua -->
                <div class="col-4 ">
                    <div class="row">
                        <!-- card agenda -->
                        <div class="col-12 mb-2">
                            <div class="agenda-card card" style="width: 18rem;">
                                <div class="card-header">
                                    <h5 class="header-title">Agenda</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 text-center date">
                                            @foreach($agendas as $agenda)
                                            <div class="date-col">{{ date('d', strtotime($agenda->tgl_mulai)) }}</div>
                                            <div class="year-col">{{ date('M Y', strtotime($agenda->tgl_mulai)) }}</div>
                                    @endforeach
                                        </div>
                                        <div class="col-8">
                                            <div class="row">
                                                <div class="col-12 mb-2">
                                                    @foreach($agendas as $agenda)
                                                    <h6 class="mt-2 judul-col">{{ $agenda->judul }}</h6>
                                                    @endforeach
                                                </div>
                                                <div class="col-12">
                                                    @foreach($agendas as $agenda)
                                                    <p class="penyelenggara-col">{{ $agenda->penyelenggara }}</p>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer footer-link">
                                    <a href="/agenda">Agenda selengkapnya</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 border-box" style="height: 62vh;">
                            <!-- card pesan -->
                            <div class="pesan-card card" style="width: 18rem;">
                                <div class="card-header">
                                    <h5 class="header-title">Pesan Masuk</h5>
                                </div>
                                <ul class="list-group list-group-flush ">
                                    @foreach($pesans as $pesan)
                                    <li class="list-group-item mt-2">
                                        <div class="media d-flex">
                                            <img src="assets/img/profil.png" class="mr-3 align-middle" alt="Icon" style="width: 56px; height: 56px;">
                                            <div class="media-body">
                                                <h5 class="mt-0" id="nama">{{$pesan->email}}</h5>
                                                <p class="" id="isi_pesan">{{$pesan->isi_pesan}}</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="card-footer footer-link">
                                    <a href="/pesan">Pesan selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Include chart scripts -->
    <script src="{{ $chart1->cdn() }}"></script>
    {{ $chart1->script() }}
    {{ $chart2->script() }}


</body>
</html>

