<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH ALUMNI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="pertanyaan" class="control-label">Pertanyaan</label>
                        <input type="text" class="form-control" id="pertanyaan" name="pertanyaan">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-pertanyaan"></div>
                    </div>
                    <div class="form-group">
                        <label for="jawaban" class="control-label">Jawaban</label>
                        <input type="text" class="form-control" id="jawaban" name="jawaban">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jawaban"></div>
                    </div>
                    <div class="form-group">
                        <label for="admin_id" class="control-label">Admin</label>
                        <select name="admin_id" id="admin_id" class="form-select" required>
                            @foreach($users as $user)
                             <option value="{{$user->id}}">{{$user->name}}</option>
                             @endforeach
                         </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-admin_id"></div>
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

            // Reset all alert messages
            $('.alert-danger').addClass('d-none').html('');

            // Validate inputs
            let isValid = true;

            if ($('#pertanyaan').val().trim() === '') {
                $('#alert-pertanyaan').removeClass('d-none').html('Pertanyaan tidak boleh kosong.');
                isValid = false;
            }
            if ($('#jawaban').val().trim() === '') {
                $('#alert-jawaban').removeClass('d-none').html('Jawaban tidak boleh kosong.');
                isValid = false;
            }
            if ($('#admin_id').val() === '') {
                $('#alert-admin_id').removeClass('d-none').html('Admin harus dipilih.');
                isValid = false;
            }

            // Jika validasi gagal, hentikan pengiriman formulir
            if (!isValid) {
                return;
            }

            var data = new FormData(this);
            data.append('pertanyaan', $('#pertanyaan').val());
            data.append('jawaban', $('#jawaban').val());
            data.append('admin_id', $('#admin_id').val());

            $.ajax({
                url: '/faq', // Update the URL to the API endpoint
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

                    let faq = `
                        <tr>
                            <td>${response.data.id}</td>
                            <td>${response.data.pertanyaan}</td>
                            <td>${response.data.jawaban}</td>
                            <td class="text-center" style="padding-right:10px">
                                <a href="javascript:void(0)" data-id="${response.data.id}" class="button-edit btn btn-sm"><i class="bi bi-pencil-square me-2"></i>Edit</a>
                            </td>
                        </tr>
                    `;
                    $('#table-faqs').append(faq); // Append the new row to the end of the table
                                    // Update the row numbers
                    $('#table-faqs tr').each(function(index) {
                        $(this).find('td:first').text(index + 1);
                    });

                    $('#modal-create').modal('hide');
                    $('#formData')[0].reset();
                },
                error: function(error) {
                    // Handle error
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.pertanyaan) {
                            $('#alert-pertanyaan').removeClass('d-none').html(error.responseJSON.errors.pertanyaan[0]);
                        }
                        if (error.responseJSON.errors.jawaban) {
                            $('#alert-jawaban').removeClass('d-none').html(error.responseJSON.errors.jawaban[0]);
                        }
                        if (error.responseJSON.errors.admin_id) {
                            $('#alert-admin_id').removeClass('d-none').html(error.responseJSON.errors.admin_id[0]);
                        }
                    }
                }
            });
        });

        // Hide alert when user starts typing or changes selection
        $('#pertanyaan, #jawaban').on('input', function() {
            $(this).next('.alert-danger').addClass('d-none').html('');
        });

        $('#admin_id').on('change', function() {
            $('#alert-admin_id').addClass('d-none').html('');
        });
    });
</script>
