@extends('layout.navbar_admin')
@section('judul_header', 'Fasilitas')

<!DOCTYPE html>
<html lang="en">
<head>
    <title>DATA FASILITAS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="../assets/css/style.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            background-color: rgb(255, 255, 255) !important;
        }
    </style>

    <!-- Load jQuery, Bootstrap and other dependencies in correct order -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <main id="main" class="main">
        <div class="container">
            <div class="table-responsive">
                <div class="mt-4" style="height: 60px">
                    <form action="/fasilitas" class="form-inline w-50 float-start" method="GET">
                        @csrf
                         <div class="input-group">
                            <input type="search" name="search" class="form-control" placeholder="Cari data ..." value="{{ request('search') }}">
                            <button class="btn btn-cari" type="submit">
                              <i class="bi bi-search"></i>
                            </button>
                          </div>
                    </form>

                    <a href="javascript:void(0)" class="button-tambah float-end" id="btn-create-post"><i class="bi bi-plus-circle me-1"></i> Tambah</a>
                </div>

                @if($dataKosong)
                    <div class="alert alert-warning mt-4" role="alert">
                        Data tidak ditemukan.
                    </div>
                @else
               <table class="table table-hoverr" style="table-layout: fixed; width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Tags</th>
                            <th scope="col">Lampiran</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-konten">
                        @foreach ($fasilitass as $index =>$konten)
                        <tr id="index_{{ $konten->id }}">
                            <td style="text-align: center">{{ ($fasilitass->currentPage() - 1) * $fasilitass->perPage() + $loop->iteration }}</td>
                            <td>{{$konten->judul}}</td>
                            <td>{{$konten->tags}}</td>
                            <td><img src="{{ url('/storage/foto/'.$konten->lampiran) }}" width="100" height="100"/></td>
                            <td class="text-center" style="padding-right:10px">
                                <a href="javascript:void(0)" id="btn-detail" data-id="{{ $konten->id }}" class="button-detail btn btn-sm">detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @endif
                @include('admin.konten.modal-create')
                @include('admin.konten.modal-update')


                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <!-- Previous Page Link -->
                        <li class="page-item {{ $fasilitass->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $fasilitass->previousPageUrl() }}">Sebelumnya</a>
                        </li>

                        <!-- Pagination Elements -->
                        @foreach ($fasilitass->getUrlRange(1, $fasilitass->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $fasilitass->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        <!-- Next Page Link -->
                        <li class="page-item {{ !$fasilitass->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $fasilitass->nextPageUrl() }}">Selanjutnya</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </main><!-- End #main -->

    </body>
</html>
