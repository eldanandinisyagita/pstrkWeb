<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH JENIS KONTEN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Jenis</label>
                        <input type="text" class="form-control" id="jenis" name="jenis">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jenis"></div>
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
    $(document).ready(function() {
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

            // Check if 'jenis' is empty
            if ($('#jenis').val() === '') {
                $('#alert-jenis').removeClass('d-none').html('Nama jenis tidak boleh kosong.');
                isValid = false;
            }

            if (!isValid) {
                return;
            }

            var data = new FormData(this);

            $.ajax({
                url: '/jenis_konten',
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

                    // Insert new row at the end of the table
                    let rowNumber = $('#table-jenis_kontens tr').length + 1;
                    let jenis_konten = `
                        <tr>
                            <td style="text-align: center">${rowNumber}</td>
                            <td style="text-align: center">${response.data.jenis}</td>
                            <td style="text-align: center"><a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="button-edit btn btn-sm"><i class="bi bi-pencil-square me-2"></i>Edit</a></td>
                        </tr>
                    `;
                    $('#table-jenis_kontens').append(jenis_konten);

                    // Update row numbers
                    $('#table-jenis_kontens tr').each(function(index) {
                        $(this).find('td:first').text(index + 1);
                    });

                    // Reset the form and close the modal
                    $('#modal-create').modal('hide');
                    $('#formData')[0].reset();
                },
                error: function(error) {
                    // Handle errors for each input
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.jenis) {
                            $('#alert-jenis').removeClass('d-none').html(error.responseJSON.errors.jenis[0]);
                        }
                    }
                }
            });
        });

        // Hide alert when user starts typing
        $('#jenis').on('input', function() {
            $('#alert-jenis').addClass('d-none').html('');
        });
    });
</script>
