<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Kontak</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formDataEdit" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    <input type="hidden" id="post_id">
                    <input type="hidden" id="row_index">
                    @csrf
                    <div class="form-group">
                        <label for="kontak-edit" class="control-label">Kontak</label>
                        <input type="text" class="form-control" id="kontak-edit" name="kontak-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kontak-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kontak-edit" class="control-label">Jenis Kontak</label>
                        <input type="text" class="form-control" id="jenis_kontak-edit" name="jenis_kontak-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jenis_kontak-edit"></div>
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
    // Button edit post event
    $('body').on('click', '#btn-edit-post', function () {
        let post_id = $(this).data('id');
        let row_index = $(this).closest('tr').index(); // Get the row index

        // Fetch detail post with AJAX
        $.ajax({
            url: '/kontak/' + post_id,
            type: "GET",
            cache: false,
            success: function(response){
                var kontak = response.data;
                // Fill data to form
                $('#post_id').val(kontak.id);
                $('#row_index').val(row_index); // Store the row index
                $('#kontak-edit').val(kontak.kontak);
                $('#jenis_kontak-edit').val(kontak.jenis_kontak);

                // Open modal
                $('#modal-edit').modal('show');
            }
        });
    });

    // Action update post
    $('#update').click(function(e) {
        e.preventDefault();
        let post_id = $('#post_id').val();
        let row_index = $('#row_index').val(); // Get the stored row index
        var form = new FormData();

        form.append('_token', $('input[name=_token]').val());
        form.append('_method', 'PUT');
        form.append('kontak', $('#kontak-edit').val());
        form.append('jenis_kontak', $('#jenis_kontak-edit').val());

        // AJAX request
        $.ajax({
            url: '/kontak/' + post_id,
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

                // Update table row at the same position
                let rowNumber = parseInt(row_index) + 1;

                let kontak = `
                <tr id="index_${response.data.id}">
                    <td class="text-center">${rowNumber}</td>
                    <td class="text-center">${response.data.kontak}</td>
                    <td class="text-center">${response.data.jenis_kontak}</td>
                    <td class="text-center"><a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="button-edit btn btn-sm"><i class="bi bi-pencil-square me-2"></i>Edit</a></td>
                </tr>
                `;

                // Replace updated row using the stored index
                $('#table-kontaks tr').eq(row_index).replaceWith(kontak);

                // Clear form
                $('#formDataEdit')[0].reset();

                // Close modal
                $('#modal-edit').modal('hide');
            },
            error: function(error){
                // Handle error
                const errorFields = ['kontak-edit', 'jenis_kontak-edit'];
                errorFields.forEach(field => {
                    if (error.responseJSON[field.replace('-edit', '')]) {
                        $(`#alert-${field}`).removeClass('d-none').html(`${field.split('-')[0].charAt(0).toUpperCase() + field.split('-')[0].slice(1)} harus diisi.`);
                    } else {
                        $(`#alert-${field}`).addClass('d-none');
                    }
                });
            }
        });
    });
});
</script>
