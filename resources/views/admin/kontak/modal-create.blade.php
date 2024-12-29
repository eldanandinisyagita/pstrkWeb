<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH DATA KONTAK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="kontak" class="control-label">Data Kontak</label>
                        <input type="text" class="form-control" id="kontak" name="kontak">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kontak"></div>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kontak" class="control-label">Jenis Kontak</label>
                        <input type="text" class="form-control" id="jenis_kontak" name="jenis_kontak">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jenis_kontak"></div>
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

        var data = new FormData(this);

        $.ajax({
            url: '/kontak', // Update the URL to the API endpoint
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
                let rowNumber = $('#table-kontaks tr').length + 1;

                let kontak = `
                    <tr>
                        <td class="text-center">${rowNumber}</td>
                        <td class="text-center">${response.data.kontak}</td>
                        <td class="text-center">${response.data.jenis_kontak}</td>
                        <td class="text-center"><a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="button-edit btn btn-sm"><i class="bi bi-pencil-square me-2"></i>Edit</a></td>
                    </tr>
                `;

                $('#table-kontaks').prepend(kontak);

                // Update the row numbers
                $('#table-kontaks tr').each(function(index) {
                    $(this).find('td:first').text(index + 1);
                });

                $('#modal-create').modal('hide');
                $('#formData')[0].reset();
            },
            error: function(error) {
                const errorFields = ['kontak', 'jenis_kontak'];
                errorFields.forEach(field => {
                    if (error.responseJSON[field]) {
                        $(`#alert-${field}`).removeClass('d-none').html(`${field.charAt(0).toUpperCase() + field.slice(1)} harus diisi.`);
                    } else {
                        $(`#alert-${field}`).addClass('d-none');
                    }
                });
            }
        });
    });
</script>
