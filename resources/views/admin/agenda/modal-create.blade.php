<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH DATA AGENDA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="control-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-judul"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-deskripsi"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tgl_mulai"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tgl_selesai"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Tags</label>
                        <input type="text" class="form-control" id="tags" name="tags" placeholder="isi : Mahasiswa | Dosen | PSTRK">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tags"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Lokasi</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-lokasi"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Penyelenggara</label>
                        <input type="text" class="form-control" id="penyelenggara" name="penyelenggara">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-penyelenggara"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TUTUP</button>
                        <button type="submit" class="btn btn-primary" id="store">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // Show modal on button click
    $('#btn-create-post').on('click', function() {
        $('#modal-create').modal('show');
    });

    // Handle form submission
    $('#formData').on('submit', function(e) {
        e.preventDefault();
        e.stopPropagation();

        // Clear previous alerts
        $('.alert').addClass('d-none').html('');

        var isValid = true;

        // Validate each input
        if ($('#judul').val().trim() === '') {
            $('#alert-judul').removeClass('d-none').html('Judul tidak boleh kosong.');
            isValid = false;
        }
        if ($('#deskripsi').val().trim() === '') {
            $('#alert-deskripsi').removeClass('d-none').html('Deskripsi tidak boleh kosong.');
            isValid = false;
        }
        if ($('#tgl_mulai').val() === '') {
            $('#alert-tgl_mulai').removeClass('d-none').html('Tanggal mulai tidak boleh kosong.');
            isValid = false;
        }
        if ($('#tgl_selesai').val() === '') {
            $('#alert-tgl_selesai').removeClass('d-none').html('Tanggal selesai tidak boleh kosong.');
            isValid = false;
        }
        if ($('#tags').val().trim() === '') {
            $('#alert-tags').removeClass('d-none').html('Tags tidak boleh kosong.');
            isValid = false;
        }
        if ($('#lokasi').val().trim() === '') {
            $('#alert-lokasi').removeClass('d-none').html('Lokasi tidak boleh kosong.');
            isValid = false;
        }
        if ($('#penyelenggara').val().trim() === '') {
            $('#alert-penyelenggara').removeClass('d-none').html('Penyelenggara tidak boleh kosong.');
            isValid = false;
        }

        if (!isValid) {
            return; // Stop execution if validation fails
        }

        var data = new FormData(this);
        data.append('judul', $('#judul').val());
        data.append('deskripsi', $('#deskripsi').val());
        data.append('tgl_mulai', $('#tgl_mulai').val());
        data.append('tgl_selesai', $('#tgl_selesai').val());
        data.append('tags', $('#tags').val());
        data.append('lokasi', $('#lokasi').val());
        data.append('penyelenggara', $('#penyelenggara').val());
        data.append('admin_id', '1');

        $.ajax({
            url: '/agenda', // Update the URL to the API endpoint
            type: 'POST',
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Data berhasil disimpan',
                    showConfirmButton: false,
                    timer: 1500
                });

                // Calculate the new row number
                let rowNumber = $('#table-agendas tr').length;

                let agenda = `
                    <tr id="index_${response.data.id}">
                        <td style="text-align: center">${rowNumber}</td>
                        <td>${response.data.judul}</td>
                        <td>${response.data.lokasi}</td>
                        <td>${response.data.tgl_mulai}</td>
                        <td><a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="button-edit btn btn-sm"><i class="bi bi-pencil-square me-2"></i>Edit</a></td>
                    </tr>
                `;
                $('#table-agendas').prepend(agenda); // Append the new row to the end of the table
                // Update the row numbers
                $('#table-agendas tr').each(function(index) {
                    $(this).find('td:first').text(index + 1);
                });

                $('#modal-create').modal('hide');
                $('#formData')[0].reset();
            },
            error: function(error) {
                // Handle server-side validation errors
                if (error.responseJSON.errors) {
                    // Validate each field and display error messages
                    if (error.responseJSON.errors.judul) {
                        $('#alert-judul').removeClass('d-none').html(error.responseJSON.errors.judul[0]);
                    }
                    if (error.responseJSON.errors.deskripsi) {
                        $('#alert-deskripsi').removeClass('d-none').html(error.responseJSON.errors.deskripsi[0]);
                    }
                    if (error.responseJSON.errors.tgl_mulai) {
                        $('#alert-tgl_mulai').removeClass('d-none').html(error.responseJSON.errors.tgl_mulai[0]);
                    }
                    if (error.responseJSON.errors.tgl_selesai) {
                        $('#alert-tgl_selesai').removeClass('d-none').html(error.responseJSON.errors.tgl_selesai[0]);
                    }
                    if (error.responseJSON.errors.tags) {
                        $('#alert-tags').removeClass('d-none').html(error.responseJSON.errors.tags[0]);
                    }
                    if (error.responseJSON.errors.lokasi) {
                        $('#alert-lokasi').removeClass('d-none').html(error.responseJSON.errors.lokasi[0]);
                    }
                    if (error.responseJSON.errors.penyelenggara) {
                        $('#alert-penyelenggara').removeClass('d-none').html(error.responseJSON.errors.penyelenggara[0]);
                    }
                }
            }
        });
    });

    // Hide alert when user starts typing
    $('#judul, #deskripsi, #tgl_mulai, #tgl_selesai, #tags, #lokasi, #penyelenggara').on('input change', function() {
        $(this).siblings('.alert').addClass('d-none').html('');
    });
</script>
