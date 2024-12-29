<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pesan </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    <input type="hidden" id="post_id">
                    @csrf
                    <div class="form-group">
                        <label for="balasan-edit" class="control-label">Balasan</label>
                        <input type="text" class="form-control" id="balasan-edit" name="balasan-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kode_mk-edit"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TUTUP</button>
                <button type="submit" class="btn btn-primary" id="update" data-bs-dismiss="modal">UPDATE</button>
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
                url: '/pesan/' + post_id,
                type: "GET",
                cache: false,
                success: function(response){
                    var pesan = response.data;

                    // Fill form with the fetched data
                    $('#post_id').val(pesan.id);
                    $('#balasan-edit').val(pesan.balasan);

                    // Show the modal
                    $('#modal-edit').modal('show');
                }
            });
        });

        // Event handler for update button in the modal
        $('#update').click(function(e) {
            e.preventDefault();
            e.stopPropagation();

            let post_id = $('#post_id').val();
            var form = new FormData();

            form.append('_token', $('input[name=_token]').val());
            form.append('_method', 'PUT');
            form.append('balasan', $('#balasan-edit').val());

            // Update data via AJAX
            $.ajax({
                url: '/pesan/' + post_id,
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
                        <td style="text-align: center">${response.data.id}</td>
                        <td style="text-align: center">${response.data.email}</td>
                        <td style="text-align: center">${response.data.isi_pesan}</td>
                        <td style="text-align: center">${response.data.balasan}</td>
                        <td class="text-center" style="padding-right:10px">
                            <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="button-edit btn btn-sm"><i class="bi bi-pencil-square me-2"></i>Edit</a>
                        </td>
                    </tr>
                    `;

                    $(`#index_${response.data.id}`).replaceWith(updatedRow);

                    // Clear form and hide modal
                    $('#formData')[0].reset();
                    $('#modal-edit').modal('hide');
                }
            });
        });
    });
</script>
