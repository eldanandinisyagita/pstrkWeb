<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH DOSEN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Anggota</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jabatan"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Departemen</label>
                        <input type="text" class="form-control" id="departemen" name="departemen">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-departemen"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Tahun</label>
                        <input type="text" class="form-control" id="tahun" name="tahun">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tahun"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-foto"></div>
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

        // Reset all alert messages
        $('.alert-danger').addClass('d-none').html('');

        // Validasi input untuk memastikan tidak ada yang kosong
        var isValid = true;

        if ($('#nama').val().trim() === '') {
            $('#alert-nama').removeClass('d-none').html('Nama tidak boleh kosong.');
            isValid = false;
        }
        if ($('#jabatan').val().trim() === '') {
            $('#alert-jabatan').removeClass('d-none').html('Jabatan tidak boleh kosong.');
            isValid = false;
        }
        if ($('#departemen').val().trim() === '') {
            $('#alert-departemen').removeClass('d-none').html('Departemen tidak boleh kosong.');
            isValid = false;
        }
        if ($('#tahun').val().trim() === '') {
            $('#alert-tahun').removeClass('d-none').html('Tahun tidak boleh kosong.');
            isValid = false;
        }
        if ($('#foto')[0].files.length === 0) {
            $('#alert-foto').removeClass('d-none').html('Foto harus diunggah.');
            isValid = false;
        }

        // Jika validasi gagal, hentikan pengiriman formulir
        if (!isValid) {
            return;
        }

        var data = new FormData(this);
        data.append('hima_id', '1'); // Assume '1' is the admin_id. Change as necessary.

        $.ajax({
            url: '/kabinet', // Update the URL to the API endpoint
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
                let rowNumber = $('#table-kabinets tr').length;

                let kabinet = `
                    <tr>
                        <td>${rowNumber}</td>
                        <td style="text-align: center">${response.data.nama}</td>
                        <td style="text-align: center">${response.data.jabatan}</td>
                        <td style="text-align: center">${response.data.departemen}</td>
                        <td style="text-align: center">${response.data.tahun}</td>
                        <td><img src="{{ url('/storage/foto/') }}/${response.data.foto}" width=100 height=100></td>
                        <td class="text-center" style="padding-right:10px"> <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="button-edit btn btn-sm"><i class="bi bi-pencil-square me-2"></i>Edit</a> </td>
                    </tr>
                `;
                $('#table-kabinets').prepend(kabinet); // Append the new row to the end of the table

                // Update the row numbers
                $('#table-kabinets tr').each(function(index) {
                    $(this).find('td:first').text(index + 1);
                });

                $('#modal-create').modal('hide');
                $('#formData')[0].reset();
            },
            error: function(error) {
                // Handle server-side validation errors
                if (error.responseJSON.errors) {
                    if (error.responseJSON.errors.nama) {
                        $('#alert-nama').removeClass('d-none').html(error.responseJSON.errors.nama[0]);
                    }
                    if (error.responseJSON.errors.jabatan) {
                        $('#alert-jabatan').removeClass('d-none').html(error.responseJSON.errors.jabatan[0]);
                    }
                    if (error.responseJSON.errors.departemen) {
                        $('#alert-departemen').removeClass('d-none').html(error.responseJSON.errors.departemen[0]);
                    }
                    if (error.responseJSON.errors.tahun) {
                        $('#alert-tahun').removeClass('d-none').html(error.responseJSON.errors.tahun[0]);
                    }
                    if (error.responseJSON.errors.foto) {
                        $('#alert-foto').removeClass('d-none').html(error.responseJSON.errors.foto[0]);
                    }
                }
            }
        });
    });

    // Hide alerts when the user starts typing or selects a file
    $('#nama, #jabatan, #departemen, #tahun').on('input', function() {
        $(this).next('.alert-danger').addClass('d-none').html('');
    });

    $('#foto').on('change', function() {
        $('#alert-foto').addClass('d-none').html('');
    });
</script>
