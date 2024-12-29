<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH DATA KURIKULUM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="control-label">Kode Mata Kuliah</label>
                        <input type="text" class="form-control" id="kode_mk" name="kode_mk">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kode"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Mata Kuliah</label>
                        <input type="text" class="form-control" id="nama_mk" name="nama_mk">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Semester</label>
                        <input type="text" class="form-control" id="smstr" name="smstr">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-smstr"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">SKS Teori</label>
                        <input type="text" class="form-control" id="sks_teori" name="sks_teori">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-teorisks"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Jam Teori</label>
                        <input type="text" class="form-control" id="jam_teori" name="jam_teori">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-teorijam"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">SKS Praktikum</label>
                        <input type="text" class="form-control" id="sks_prak" name="sks_prak">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-praksks"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Jam Praktikum</label>
                        <input type="text" class="form-control" id="jam_prak" name="jam_prak">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-prakjam"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
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
        $('.alert').addClass('d-none').text('');

        var isValid = true;

        // Check each input for empty values and show an alert if any are empty
        if ($('#kode_mk').val() === '') {
            $('#alert-kode').removeClass('d-none').html('Kode mata kuliah tidak boleh kosong.');
            isValid = false;
        }
        if ($('#nama_mk').val() === '') {
            $('#alert-nama').removeClass('d-none').html('Nama mata kuliah tidak boleh kosong.');
            isValid = false;
        }
        if ($('#smstr').val() === '') {
            $('#alert-smstr').removeClass('d-none').html('Semester tidak boleh kosong.');
            isValid = false;
        }
        if ($('#sks_teori').val() === '') {
            $('#alert-teorisks').removeClass('d-none').html('SKS teori tidak boleh kosong.');
            isValid = false;
        }
        if ($('#jam_teori').val() === '') {
            $('#alert-teorijam').removeClass('d-none').html('Jam teori tidak boleh kosong.');
            isValid = false;
        }
        if ($('#sks_prak').val() === '') {
            $('#alert-praksks').removeClass('d-none').html('SKS praktikum tidak boleh kosong.');
            isValid = false;
        }
        if ($('#jam_prak').val() === '') {
            $('#alert-prakjam').removeClass('d-none').html('Jam praktikum tidak boleh kosong.');
            isValid = false;
        }

        if (!isValid) {
            return;
        }

        var data = new FormData(this);

        $.ajax({
            url: '/kurikulum',
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

                let rowNumber = $('#table-kurikulums tr').length;

                let kurikulum = `
                    <tr>
                        <td style="text-align: center">${rowNumber}</td>
                        <td>${response.data.kode_mk}</td>
                        <td>${response.data.nama_mk}</td>
                        <td>${response.data.smstr}</td>
                        <td>${response.data.sks_teori}</td>
                        <td>${response.data.jam_teori}</td>
                        <td>${response.data.sks_prak}</td>
                        <td>${response.data.jam_prak}</td>

                        <td><a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="button-edit btn btn-sm"><i class="bi bi-pencil-square me-2"></i>Edit</a></td>
                    </tr>
                `;
                $('#table-kurikulums').prepend(kurikulum);
                $('#table-kurikulums tr').each(function(index) {
                    $(this).find('td:first').text(index + 1);
                });
                $('#modal-create').modal('hide');
                $('#formData')[0].reset();
            },
            error: function(error) {
                // Handle error from the server
                if (error.responseJSON.errors) {
                    const errors = error.responseJSON.errors;
                    if (errors.kode_mk) {
                        $('#alert-kode').removeClass('d-none').html(errors.kode_mk[0]);
                    }
                    if (errors.nama_mk) {
                        $('#alert-nama').removeClass('d-none').html(errors.nama_mk[0]);
                    }
                    if (errors.smstr) {
                        $('#alert-smstr').removeClass('d-none').html(errors.smstr[0]);
                    }
                    if (errors.sks_teori) {
                        $('#alert-teorisks').removeClass('d-none').html(errors.sks_teori[0]);
                    }
                    if (errors.jam_teori) {
                        $('#alert-teorijam').removeClass('d-none').html(errors.jam_teori[0]);
                    }
                    if (errors.sks_prak) {
                        $('#alert-praksks').removeClass('d-none').html(errors.sks_prak[0]);
                    }
                    if (errors.jam_prak) {
                        $('#alert-prakjam').removeClass('d-none').html(errors.jam_prak[0]);
                    }
                }
            }
        });
    });

    // Clear alerts when typing again
    $('#kode_mk, #nama_mk, #smstr, #sks_teori, #jam_teori, #sks_prak, #jam_prak').on('input', function() {
        $(this).next('.alert').addClass('d-none').text('');
    });
</script>
