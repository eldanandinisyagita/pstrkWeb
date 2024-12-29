<!-- Modal Detail/Edit Data Kurikulum -->
<div class="modal fade" id="modalDetailKurikulum" tabindex="-1" role="dialog" aria-labelledby="modalDetailKurikulumLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailKurikulumLabel">Detail Kurikulum</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formDetailKurikulum" enctype="multipart/form-data" method="POST" action="{{ route('kurikulum.update', $kurikulum->id) }}">
                    @method('PUT')
                    <input type="hidden" id="post_id">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kode_mk_detail" class="mb-1">Kode Mata Kuliah</label>
                                <input type="text" class="form-control" id="kode_mk_detail" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kode_mk_detail"></div>
                            </div>
                            <div class="form-group">
                                <label for="nama_mk_detail" class="mb-1">Nama Mata Kuliah</label>
                                <input type="text" class="form-control" id="nama_mk_detail" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama_mk_detail"></div>
                            </div>
                            <div class="form-group">
                                <label for="smstr_detail" class="mb-1">Semester</label>
                                <input type="number" class="form-control" id="smstr_detail" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-smstr_detail"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sks_teori_detail" class="mb-1">SKS Teori</label>
                                <input type="number" class="form-control" id="sks_teori_detail" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-sks_teori_detail"></div>
                            </div>
                            <div class="form-group">
                                <label for="jam_teori_detail" class="mb-1">Jam Teori</label>
                                <input type="number" class="form-control" id="jam_teori_detail" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jam_teori_detail"></div>
                            </div>
                            <div class="form-group">
                                <label for="sks_prak_detail" class="mb-1">SKS Praktikum</label>
                                <input type="number" class="form-control" id="sks_prak_detail" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-sks_prak_detail"></div>
                            </div>
                            <div class="form-group">
                                <label for="jam_prak_detail" class="mb-1">Jam Praktikum</label>
                                <input type="number" class="form-control" id="jam_prak_detail" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jam_prak_detail"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="editKurikulumButton">Edit</button>
                <button type="button" class="btn btn-primary d-none" id="saveKurikulumChanges">Simpan</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).on('click', '.button-detail', function() {
        var kurikulumId = $(this).data('id');

        // Ambil data kurikulum dari server
        $.ajax({
            url: '/kurikulum/' + kurikulumId,
            type: 'GET',
            success: function(response) {
                var kurikulum = response.data;

                // Isi data ke dalam modal
                $('#post_id').val(kurikulum.id);
                $('#kode_mk_detail').val(kurikulum.kode_mk);
                $('#nama_mk_detail').val(kurikulum.nama_mk);
                $('#smstr_detail').val(kurikulum.smstr);
                $('#sks_teori_detail').val(kurikulum.sks_teori);
                $('#jam_teori_detail').val(kurikulum.jam_teori);
                $('#sks_prak_detail').val(kurikulum.sks_prak);
                $('#jam_prak_detail').val(kurikulum.jam_prak);

                // Tampilkan modal detail
                $('#modalDetailKurikulum').modal('show');
            }
        });
    });

    // Mode edit saat tombol "Edit" ditekan
    $('#editKurikulumButton').click(function() {
        $('#kode_mk_detail, #nama_mk_detail, #smstr_detail, #sks_teori_detail, #jam_teori_detail, #sks_prak_detail, #jam_prak_detail').prop('readonly', false);
        $('#saveKurikulumChanges').removeClass('d-none'); // Tampilkan tombol Simpan
        $(this).addClass('d-none'); // Sembunyikan tombol Edit
    });

    // Tombol Simpan untuk menyimpan perubahan
    $('#saveKurikulumChanges').click(function(e) {
        e.preventDefault();
        e.stopPropagation();

        // Hapus alert error sebelumnya
        $('.alert-danger').remove();

        var isValid = true;
        var kurikulumId = $('#post_id').val();
        var formData = new FormData();

        // Validasi input
        if ($('#kode_mk_detail').val().trim() === '') {
            $('#kode_mk_detail').after('<div class="alert alert-danger">Kolom Kode Mata Kuliah tidak boleh kosong</div>');
            isValid = false;
        }
        if ($('#nama_mk_detail').val().trim() === '') {
            $('#nama_mk_detail').after('<div class="alert alert-danger">Kolom Nama Mata Kuliah tidak boleh kosong</div>');
            isValid = false;
        }
        if ($('#smstr_detail').val().trim() === '') {
            $('#smstr_detail').after('<div class="alert alert-danger">Kolom Semester tidak boleh kosong</div>');
            isValid = false;
        }
        if ($('#sks_teori_detail').val().trim() === '') {
            $('#sks_teori_detail').after('<div class="alert alert-danger">Kolom SKS Teori tidak boleh kosong</div>');
            isValid = false;
        }
        if ($('#jam_teori_detail').val().trim() === '') {
            $('#jam_teori_detail').after('<div class="alert alert-danger">Kolom Jam Teori tidak boleh kosong</div>');
            isValid = false;
        }
        if ($('#sks_prak_detail').val().trim() === '') {
            $('#sks_prak_detail').after('<div class="alert alert-danger">Kolom SKS Praktikum tidak boleh kosong</div>');
            isValid = false;
        }
        if ($('#jam_prak_detail').val().trim() === '') {
            $('#jam_prak_detail').after('<div class="alert alert-danger">Kolom Jam Praktikum tidak boleh kosong</div>');
            isValid = false;
        }

        if (!isValid) {
            return; // Hentikan jika validasi gagal
        }

        // Tambahkan data ke formData
        formData.append('_token', $('input[name=_token]').val());
        formData.append('_method', 'PUT');
        formData.append('kode_mk', $('#kode_mk_detail').val());
        formData.append('nama_mk', $('#nama_mk_detail').val());
        formData.append('smstr', $('#smstr_detail').val());
        formData.append('sks_teori', $('#sks_teori_detail').val());
        formData.append('jam_teori', $('#jam_teori_detail').val());
        formData.append('sks_prak', $('#sks_prak_detail').val());
        formData.append('jam_prak', $('#jam_prak_detail').val());

        $.ajax({
            url: '/kurikulum/' + kurikulumId,
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

                // Update data kurikulum di tabel
                let kurikulumRow = `
                    <tr id="index_${response.data.id}">
                        <td class="row-index"></td>
                        <td>${response.data.kode_mk}</td>
                        <td>${response.data.nama_mk}</td>
                        <td>${response.data.smstr}</td>
                        <td><a href="javascript:void(0)" class="button-detail btn btn-sm" data-id="${response.data.id}">detail</a></td>
                    </tr>
                `;

                $(`#index_${response.data.id}`).replaceWith(kurikulumRow);

                // Set input kembali ke mode readonly
                $('#kode_mk_detail, #nama_mk_detail, #smstr_detail, #sks_teori_detail, #jam_teori_detail, #sks_prak_detail, #jam_prak_detail').prop('readonly', true);
                $('#editKurikulumButton').removeClass('d-none');
                $('#saveKurikulumChanges').addClass('d-none');

                $('#modalDetailKurikulum').modal('hide');

                // Perbarui nomor urut di tabel setelah data diupdate
                updateRowNumbers();
            }
        });
    });

    // Fungsi untuk memperbarui nomor urut setiap baris sesuai posisi di tabel
    function updateRowNumbers() {
        $('#table-kurikulums tr').each(function(index) {
            $(this).find('.row-index').text(index + 1); // Update nomor urut mulai dari 1
        });
    }

    // Hapus alert saat mengetik
    $('#kode_mk_detail, #nama_mk_detail, #smstr_detail, #sks_teori_detail, #jam_teori_detail, #sks_prak_detail, #jam_prak_detail').on('input', function() {
        $(this).next('.alert-danger').remove();
    });
</script>
