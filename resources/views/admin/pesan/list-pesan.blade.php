@extends('layout.navbar_admin')
@section('judul_header', 'Pesan')

<html lang="en">
    <head>
        <title>DATA PESAN</title>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="../assets/css/style.css" rel="stylesheet">
        {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet"> --}}

        {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

        <style>
            body {
                background-color: rgb(255, 255, 255) !important;
            }
        </style>
        {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script> --}}
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js">
        </script>
        <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js">
        </script>
        <script
            src="//cdn.jsdelivr.net/npm/sweetalert2@11">
        </script>
                <script
            src="https://code.jquery.com/jquery-3.5.1.js">
        </script>
        <script
            src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js">
        </script>
        <script
            src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js">
        </script>

    </head>
    <body>
        <main id="main" class="main">
            <div class="container">
                <div class="table-responsive">
                    <div class="mt-4" style="height: 60px">
                        <form action="/pesan" class="form-inline w-50 float-start" method="GET">
                            @csrf

<div class="input-group">
                             <div class="input-group">
                            <input type="search" name="search" class="form-control" placeholder="Cari data ..." value="{{ request('search') }}">
                            <button class="btn btn-cari" type="submit">
                              <i class="bi bi-search"></i>
                            </button>
                          </div>
                        </div>

                        </form>
                    </div>

                    @if($dataKosong)
                        <div class="alert alert-warning mt-4" role="alert">
                            Data tidak ditemukan.
                        </div>
                    @else
                   <table class="table table-hoverr">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Email</th>
                                <th scope="col">Isi Pesan</th>
                                <th scope="col">Balasan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table-pesans">
                            @foreach ($pesans as $index =>$pesan)
                            <tr id="index_{{ $pesan->id }}">
                                <td style="text-align: center">{{ ($pesans->currentPage() - 1) * $pesans->perPage() + $loop->iteration }}</td>
                                <td>{{$pesan->email}}</td>
                                <td>{{$pesan->isi_pesan}}</td>
                                <td>{{$pesan->balasan}}</td>
                                <td class="text-center" style="padding-right:10px"> <a href="javascript:void(0)" id="btn-edit-post" data-id="{{ $pesan->id }}" class="button-edit btn btn-sm"><i class="bi bi-pencil-square me-2"></i>Edit</a> </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('admin.pesan.modal-update')
                    @endif

                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <!-- Previous Page Link -->
                            <li class="page-item {{ $pesans->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $pesans->previousPageUrl() }}" style="te">Previous</a>
                            </li>

                            <!-- Pagination Elements -->
                            @foreach ($pesans->getUrlRange(1, $pesans->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $pesans->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            <!-- Next Page Link -->
                            <li class="page-item {{ !$pesans->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $pesans->nextPageUrl() }}">Selanjutnya</a>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>

            <script>
                $(document).ready(function () {
                    let lastMessageId = null;

                    // Fungsi untuk memeriksa pesan baru
                    function checkNewMessages() {
                        $.ajax({
                            url: '/check-new-messages',
                            method: 'GET',
                            success: function (data) {
                                if (data.latestMessage) {
                                    if (lastMessageId === null) {
                                        // Inisialisasi lastMessageId jika belum ada
                                        lastMessageId = data.latestMessage.id;
                                    } else if (data.latestMessage.id !== lastMessageId) {
                                        // Jika ada pesan baru
                                        alert('Ada pesan baru masuk!');
                                        lastMessageId = data.latestMessage.id;
                                    }
                                }
                            }
                        });
                    }

                    // Periksa pesan baru setiap 10 detik
                    setInterval(checkNewMessages, 10000);
                });
            </script>
        </main><!-- End #main -->

    </body>
</html>
