@extends('layout.navbar_admin')
@section('judul_header', 'Info Hima')

<!DOCTYPE html>
<html lang="en">
<head>
    <title>DATA HIMA</title>
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
            <div class="modal-body">
                @foreach ($himas as $index => $hima)
                <form id="formHima" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    @csrf

                    <input type="hidden" id="post_id" value="{{ $hima->id }}">
                    <div class="row mt-4">

                        <!-- Left Column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_detail" class="control-label">Nama HIMA</label>
                                <input type="text" class="form-control" id="nama_detail" value="{{ $hima->nama }}" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama_detail"></div>
                            </div>
                            <img id="fotoDetail" src="{{ url('/storage/foto/'.$hima->foto) }}" class="img-fluid rounded" width="300" height="auto">
                            <div class="form-group">
                                <label for="foto_detail" class="control-label">Foto</label>
                                <input type="text" class="form-control mb-2" id="foto_detail" value="{{ $hima->foto }}" readonly>
                                <input type="file" class="form-control d-none" id="editFoto" name="foto">
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-foto_detail"></div>
                            </div>

                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sejarah_detail" class="control-label">Sejarah</label>
                                <textarea class="form-control" id="sejarah_detail" rows="2" readonly>{{ $hima->sejarah }}</textarea>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-sejarah_detail"></div>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_detail" class="control-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi_detail" rows="2" readonly>{{ $hima->deskripsi }}</textarea>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-deskripsi_detail"></div>
                            </div>
                            <div class="form-group">
                                <label for="visi_detail" class="control-label">Visi Hima</label>
                                <textarea class="form-control" id="visi_detail" rows="2" readonly>{{ $hima->visi }}</textarea>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-visi_detail"></div>
                            </div>
                            <div class="form-group">
                                <label for="misi_detail" class="control-label">Misi Hima</label>
                                <textarea class="form-control" id="misi_detail" rows="2" readonly>{{ $hima->misi }}</textarea>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-misi_detail"></div>
                            </div>

                        </div>

                    </div>
                </form>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="editHimaButton">Edit</button>
                <button type="button" class="btn btn-primary d-none" id="saveHimaChanges">Save</button>
            </div>
        </main>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       $(document).ready(function() {
    // Aktifkan mode edit saat tombol "Edit" diklik
    $('#editHimaButton').click(function() {
        $('#nama_detail, #sejarah_detail, #deskripsi_detail, #visi_detail, #misi_detail').prop('readonly', false);

        // Tampilkan input file dan tombol save, sembunyikan tombol edit
        $('#editFoto').removeClass('d-none');
        $('#saveHimaChanges').removeClass('d-none');
        $(this).addClass('d-none');
    });

    // Simpan perubahan saat tombol "Save" diklik
    $('#saveHimaChanges').click(function(e) {
        e.preventDefault();
        e.stopPropagation();

        // Hapus alert error sebelumnya
        $('.alert-danger').addClass('d-none');

        var isValid = true;
        var himaId = $('#post_id').val();
        var formData = new FormData();

        // Validasi input
        if ($('#nama_detail').val().trim() === '') {
            $('#alert-nama_detail').removeClass('d-none').html('Kolom Nama tidak boleh kosong');
            isValid = false;
        }
        if ($('#sejarah_detail').val().trim() === '') {
            $('#alert-sejarah_detail').removeClass('d-none').html('Kolom Sejarah tidak boleh kosong');
            isValid = false;
        }
        if ($('#deskripsi_detail').val().trim() === '') {
            $('#alert-deskripsi_detail').removeClass('d-none').html('Kolom Deskripsi tidak boleh kosong');
            isValid = false;
        }
        if ($('#visi_detail').val().trim() === '') {
            $('#alert-visi_detail').removeClass('d-none').html('Kolom Visi tidak boleh kosong');
            isValid = false;
        }
        if ($('#misi_detail').val().trim() === '') {
            $('#alert-misi_detail').removeClass('d-none').html('Kolom Misi tidak boleh kosong');
            isValid = false;
        }

        // Berhenti jika validasi gagal
        if (!isValid) {
            return;
        }

        // Masukkan data ke formData
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
        formData.append('_method', 'PUT');
        formData.append('nama', $('#nama_detail').val());
        formData.append('sejarah', $('#sejarah_detail').val());
        formData.append('deskripsi', $('#deskripsi_detail').val());
        formData.append('visi', $('#visi_detail').val());
        formData.append('misi', $('#misi_detail').val());

        if ($('#editFoto')[0].files[0]) {
            formData.append('foto', $('#editFoto')[0].files[0]);
        }

        // Kirim data dengan AJAX
        $.ajax({
            url: '/hima/' + himaId, // Ganti dengan route yang sesuai
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });

                // Perbarui data di tampilan atau tabel jika ada
                $('#nama_detail').val(response.data.nama);
                $('#sejarah_detail').val(response.data.sejarah);
                $('#deskripsi_detail').val(response.data.deskripsi);
                $('#visi_detail').val(response.data.visi);
                $('#misi_detail').val(response.data.misi);
                if (response.data.foto) {
                    $('#fotoDetail').attr('src', '/storage/foto/' + response.data.foto);
                }

                // Kembali ke mode read-only
                $('#nama_detail, #sejarah_detail, #deskripsi_detail, #visi_detail, #misi_detail').prop('readonly', true);
                $('#editHimaButton').removeClass('d-none');
                $('#saveHimaChanges').addClass('d-none');
                $('#editFoto').addClass('d-none');
            },
            error: function(error) {
                Swal.fire('Gagal menyimpan data.', 'Periksa kembali data yang dimasukkan.', 'error');
            }
        });
    });

    // Hapus alert saat user mulai mengetik di kolom input
    $('#nama_detail, #sejarah_detail, #deskripsi_detail, #visi_detail, #misi_detail').on('input', function() {
        $(this).next('.alert-danger').addClass('d-none');
    });
});

    </script>


</body>
</html>
