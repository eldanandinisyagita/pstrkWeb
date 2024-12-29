<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Jenis Konten</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    <input type="hidden" id="post_id">
                    @csrf
                    <div class="form-group">
                        <label for="jenis-edit" class="control-label">Jenis Konten</label>
                        <input type="text" class="form-control" id="jenis-edit" name="jenis-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jenis-edit"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TUTUP</button>
                <button type="submit" class="btn btn-primary" id="update">SIMPAN</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
    // Event handler for edit button
    $('body').on('click', '#btn-edit-post', function () {
        let post_id = $(this).data('id');

        // Fetch data for the selected post
        $.ajax({
            url: '/jenis_konten/' + post_id,
            type: "GET",
            cache: false,
            success: function(response){
                var jenis_konten = response.data;

                // Fill form with the fetched data
                $('#post_id').val(jenis_konten.id);
                $('#jenis-edit').val(jenis_konten.jenis);

                // Show the modal
                $('#modal-edit').modal('show');
            }
        });
    });

    // Event handler for update button in the modal
    $('#update').click(function(e) {
        e.preventDefault();
        e.stopPropagation();

        // Clear previous alerts
        $('#alert-jenis-edit').addClass('d-none').html('');

        var isValid = true;

        // Check if 'jenis-edit' is empty
        if ($('#jenis-edit').val().trim() === '') {
            $('#alert-jenis-edit').removeClass('d-none').html('Jenis konten tidak boleh kosong.');
            isValid = false;
        }

        if (!isValid) {
            return; // Stop execution if validation fails
        }

        let post_id = $('#post_id').val();
        var form = new FormData();

        form.append('_token', $('input[name=_token]').val());
        form.append('_method', 'PUT');
        form.append('jenis', $('#jenis-edit').val());

        // Update data via AJAX
        $.ajax({
            url: '/jenis_konten/' + post_id,
            type: "POST",
            data: form,
            processData: false,
            contentType: false,
            success: function(response){
                Swal.fire({
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });

                // Update the corresponding row in the table
                let updatedRow = `
                <tr id="index_${response.data.id}">
                    <td style="text-align: center"></td> <!-- Empty initially -->
                    <td style="text-align: center">${response.data.jenis}</td>
                    <td class="text-center" style="padding-right:10px">
                        <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="button-edit btn btn-sm"><i class="bi bi-pencil-square me-2"></i>Edit</a>
                    </td>
                </tr>
                `;

                $(`#index_${response.data.id}`).replaceWith(updatedRow);

                // Recalculate and update row numbers
                $('#table-jenis_kontens tr').each(function(index) {
                    $(this).find('td:first').text(index + 1);
                });

                // Clear form and hide modal
                $('#formData')[0].reset();
                $('#modal-edit').modal('hide');
            },
            error: function(error) {
                // Handle errors for each input
                if (error.responseJSON.errors) {
                    // Check if error contains 'jenis-edit'
                    if (error.responseJSON.errors.jenis) {
                        $('#alert-jenis-edit').removeClass('d-none').html(error.responseJSON.errors.jenis[0]);
                    }
                }
            }
        });
    });

    // Hide alert when user starts typing
    $('#jenis-edit').on('input', function() {
        $('#alert-jenis-edit').addClass('d-none').html('');
    });
});

</script>
