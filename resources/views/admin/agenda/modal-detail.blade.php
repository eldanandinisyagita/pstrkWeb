<!-- Modal Detail/Edit Agenda -->
<div class="modal fade" id="agendaDetailModal" tabindex="-1" role="dialog" aria-labelledby="agendaDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agendaDetailModalLabel">Detail Agenda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="agendaDetailForm" enctype="multipart/form-data" method="POST" action="{{ route('agenda.update', $agenda->id) }}">
                    @method('PUT')
                    <input type="hidden" id="post_id">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="judulDetail" class="mb-1">Judul Agenda</label>
                                <input type="text" class="form-control" id="judulDetail" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-judulDetail"></div>
                            </div>
                            <div class="form-group">
                                <label for="tglMulaiDetail" class="mb-1">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="tglMulaiDetail" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tglMulaiDetail"></div>
                            </div>
                            <div class="form-group">
                                <label for="tglSelesaiDetail" class="mb-1">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="tglSelesaiDetail" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tglSelesaiDetail"></div>
                            </div>
                            <div class="form-group">
                                <label for="tagsDetail" class="mb-1">Tags</label>
                                <input type="text" class="form-control" id="tagsDetail" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tagsDetail"></div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="penyelenggaraDetail" class="mb-1">Penyelenggara</label>
                                <input type="text" class="form-control" id="penyelenggaraDetail" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-penyelenggaraDetail"></div>
                            </div>
                            <div class="form-group">
                                <label for="lokasiDetail" class="mb-1">Lokasi</label>
                                <input type="text" class="form-control" id="lokasiDetail" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-lokasiDetail"></div>
                            </div>
                            <div class="form-group">
                                <label for="deskripsiDetail" class="mb-1">Deskripsi</label>
                                <textarea class="form-control" id="deskripsiDetail" rows="3" readonly></textarea>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-deskripsiDetail"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="editAgendaButton">Edit</button>
                <button type="button" class="btn btn-primary d-none" id="updateAgendaButton">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '.button-detail', function() {
    var agendaId = $(this).data('id');

    // Ambil data agenda dari server
    $.ajax({
        url: '/agenda/' + agendaId,
        type: 'GET',
        success: function(response) {
            var agenda = response.data;

            // Isi data ke dalam modal
            $('#post_id').val(agenda.id);
            $('#judulDetail').val(agenda.judul);
            $('#deskripsiDetail').val(agenda.deskripsi);
            $('#tglMulaiDetail').val(agenda.tgl_mulai);
            $('#tglSelesaiDetail').val(agenda.tgl_selesai);
            $('#tagsDetail').val(agenda.tags);
            $('#lokasiDetail').val(agenda.lokasi);
            $('#penyelenggaraDetail').val(agenda.penyelenggara);

            // Tampilkan modal detail
            $('#agendaDetailModal').modal('show');
        }
    });
});

// Mode edit saat tombol "Edit" ditekan
$('#editAgendaButton').click(function() {
    $('#judulDetail, #deskripsiDetail, #tglMulaiDetail, #tglSelesaiDetail, #tagsDetail, #lokasiDetail, #penyelenggaraDetail').prop('readonly', false);
    $('#saveAgendaChanges').removeClass('d-none'); // Tampilkan tombol Simpan
    $(this).addClass('d-none'); // Sembunyikan tombol Edit
});


// Aktifkan form edit agenda
$('#editAgendaButton').click(function() {
    $('#judulDetail, #deskripsiDetail, #tglMulaiDetail, #tglSelesaiDetail, #tagsDetail, #lokasiDetail, #penyelenggaraDetail').prop('readonly', false);
    $('#updateAgendaButton').removeClass('d-none');
    $(this).addClass('d-none'); // Sembunyikan tombol edit
});

$('#updateAgendaButton').click(function(e) {
    e.preventDefault();
    e.stopPropagation();

    // Hapus alert error sebelumnya
    $('.alert-danger').remove();

    var isValid = true;
    var agendaId = $('#post_id').val();
    var formData = new FormData();

    // Validasi input
    if ($('#judulDetail').val().trim() === '') {
        $('#judulDetail').after('<div class="alert alert-danger">Kolom Judul tidak boleh kosong</div>');
        isValid = false;
    }
    if ($('#deskripsiDetail').val().trim() === '') {
        $('#deskripsiDetail').after('<div class="alert alert-danger">Kolom Deskripsi tidak boleh kosong</div>');
        isValid = false;
    }
    if ($('#tglMulaiDetail').val().trim() === '') {
        $('#tglMulaiDetail').after('<div class="alert alert-danger">Kolom Tanggal Mulai tidak boleh kosong</div>');
        isValid = false;
    }
    if ($('#tglSelesaiDetail').val().trim() === '') {
        $('#tglSelesaiDetail').after('<div class="alert alert-danger">Kolom Tanggal Selesai tidak boleh kosong</div>');
        isValid = false;
    }
    if ($('#tagsDetail').val().trim() === '') {
        $('#tagsDetail').after('<div class="alert alert-danger">Kolom Tags tidak boleh kosong</div>');
        isValid = false;
    }
    if ($('#lokasiDetail').val().trim() === '') {
        $('#lokasiDetail').after('<div class="alert alert-danger">Kolom Lokasi tidak boleh kosong</div>');
        isValid = false;
    }
    if ($('#penyelenggaraDetail').val().trim() === '') {
        $('#penyelenggaraDetail').after('<div class="alert alert-danger">Kolom Penyelenggara tidak boleh kosong</div>');
        isValid = false;
    }

    if (!isValid) {
        return; // Hentikan jika validasi gagal
    }

    // Tambahkan data ke formData
    formData.append('_token', $('input[name=_token]').val());
    formData.append('_method', 'PUT');
    formData.append('judul', $('#judulDetail').val());
    formData.append('deskripsi', $('#deskripsiDetail').val());
    formData.append('tgl_mulai', $('#tglMulaiDetail').val());
    formData.append('tgl_selesai', $('#tglSelesaiDetail').val());
    formData.append('tags', $('#tagsDetail').val());
    formData.append('lokasi', $('#lokasiDetail').val());
    formData.append('penyelenggara', $('#penyelenggaraDetail').val());

    $.ajax({
        url: '/agenda/' + agendaId,
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

            // Update data agenda di tabel
            let agenda = `
            <tr id="index_${response.data.id}">
                <td class="row-index"></td>
                <td>${response.data.judul}</td>
                <td>${response.data.lokasi}</td>
                <td>${response.data.tgl_mulai}</td>
                <td><a href="javascript:void(0)" class="button-detail btn btn-sm" data-id="${response.data.id}">detail</a></td>
            </tr>
        `;

        $(`#index_${response.data.id}`).replaceWith(agenda);

      // Set kembali input menjadi readonly
        $('#judulDetail, #deskripsiDetail, #tglMulaiDetail, #tglSelesaiDetail, #tagsDetail, #lokasiDetail, #penyelenggaraDetail').prop('readonly', true);
        $('#editAgendaButton').removeClass('d-none');
        $('#updateAgendaButton').addClass('d-none');

        $('#agendaDetailModal').modal('hide');

        // Perbarui nomor urut di tabel setelah data diupdate
        updateRowNumbers();
            }
        });
    });

    // Fungsi untuk memperbarui nomor urut setiap baris
    // Fungsi untuk memperbarui nomor urut setiap baris sesuai posisi di tabel
    function updateRowNumbers() {
        $('#table-agendas tr').each(function(index) {
            $(this).find('.row-index').text(index + 1); // Update nomor urut mulai dari 1
        });
    }


    // Hapus alert saat mengetik
    $('#judulDetail, #deskripsiDetail, #tglMulaiDetail, #tglSelesaiDetail, #tagsDetail, #lokasiDetail, #penyelenggaraDetail').on('input', function() {
        $(this).next('.alert-danger').remove();
    });
</script>
