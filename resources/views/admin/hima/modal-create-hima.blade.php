<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">DATA HIMA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Himpunan</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Sejarah</label>
                        <input type="text" class="form-control" id="sejarah" name="sejarah">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-sejarah"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Visi</label>
                        <input type="text" class="form-control" id="visi" name="visi">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-visi"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Misi</label>
                        <input type="text" class="form-control" id="misi" name="misi">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-misi"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-deskripsi"></div>
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

        // Clear previous alerts
        $('.alert').addClass('d-none').html('');

        var isValid = true;

        // Validate each input
        if ($('#nama').val().trim() === '') {
            $('#alert-nama').removeClass('d-none').html('Nama tidak boleh kosong.');
            isValid = false;
        }
        if ($('#sejarah').val().trim() === '') {
            $('#alert-sejarah').removeClass('d-none').html('Sejarah tidak boleh kosong.');
            isValid = false;
        }
        if ($('#visi').val().trim() === '') {
            $('#alert-visi').removeClass('d-none').html('Visi tidak boleh kosong.');
            isValid = false;
        }
        if ($('#misi').val().trim() === '') {
            $('#alert-misi').removeClass('d-none').html('Misi tidak boleh kosong.');
            isValid = false;
        }
        if ($('#deskripsi').val().trim() === '') {
            $('#alert-deskripsi').removeClass('d-none').html('Deskripsi tidak boleh kosong.');
            isValid = false;
        }
        if ($('#foto')[0].files.length === 0) {
            $('#alert-foto').removeClass('d-none').html('Foto harus diunggah.');
            isValid = false;
        }

        if (!isValid) {
            return; // Stop execution if validation fails
        }

        var data = new FormData(this);
        data.append('admin_id', '1'); // Assume '1' is the admin_id. Change as necessary.

        $.ajax({
            url: '/hima', // Update the URL to the API endpoint
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
                let rowNumber = $('#table-himas tr').length;

                let hima = `
                    <tr>
                        <td>${rowNumber}</td>
                        <td>${response.data.nama}</td>
                        <td>${response.data.sejarah}</td>
                        <td>${response.data.visi}</td>
                        <td>${response.data.misi}</td>
                        <td>${response.data.deskripsi}</td>
                        <td>${response.data.foto}</td>
                        <td><a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="button-edit btn btn-sm"><i class="bi bi-pencil-square me-2"></i>Edit</a></td>
                    </tr>
                `;
                $('#table-himas').prepend(hima); // Append the new row to the end of the table
                // Update the row numbers
                $('#table-himas tr').each(function(index) {
                    $(this).find('td:first').text(index + 1);});
                $('#modal-create').modal('hide');
                $('#formData')[0].reset();
            },
            error: function(error) {
                // Handle server-side validation errors
                if (error.responseJSON.errors) {
                    if (error.responseJSON.errors.nama) {
                        $('#alert-nama').removeClass('d-none').html(error.responseJSON.errors.nama[0]);
                    }
                    if (error.responseJSON.errors.sejarah) {
                        $('#alert-sejarah').removeClass('d-none').html(error.responseJSON.errors.sejarah[0]);
                    }
                    if (error.responseJSON.errors.visi) {
                        $('#alert-visi').removeClass('d-none').html(error.responseJSON.errors.visi[0]);
                    }
                    if (error.responseJSON.errors.misi) {
                        $('#alert-misi').removeClass('d-none').html(error.responseJSON.errors.misi[0]);
                    }
                    if (error.responseJSON.errors.deskripsi) {
                        $('#alert-deskripsi').removeClass('d-none').html(error.responseJSON.errors.deskripsi[0]);
                    }
                    if (error.responseJSON.errors.foto) {
                        $('#alert-foto').removeClass('d-none').html(error.responseJSON.errors.foto[0]);
                    }
                }
            }
        });
    });

    // Remove alert messages when typing
    $('#nama, #sejarah, #visi, #misi, #deskripsi, #foto').on('input change', function() {
        $(this).siblings('.alert').addClass('d-none').html('');
    });
</script>
