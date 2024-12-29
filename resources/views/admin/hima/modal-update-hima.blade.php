<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Himpunan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditData" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    <input type="hidden" id="post_id" name="post_id">
                    @csrf
                    <div class="form-group">
                        <label for="nama-edit" class="control-label">Nama Himpunan</label>
                        <input type="text" class="form-control" id="nama-edit" name="nama">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="sejarah-edit" class="control-label">Sejarah Himpunan</label>
                        <input type="text" class="form-control" id="sejarah-edit" name="sejarah">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-sejarah-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="visi-edit" class="control-label">Visi Himpunan</label>
                        <input type="text" class="form-control" id="visi-edit" name="visi">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-visi-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="misi-edit" class="control-label">Misi Himpunan</label>
                        <input type="text" class="form-control" id="misi-edit" name="misi">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-misi-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi-edit" class="control-label">Deskripsi Himpunan</label>
                        <input type="text" class="form-control" id="deskripsi-edit" name="deskripsi">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-deskripsi-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="foto-edit" class="control-label">Foto</label>
                        <input type="text" class="form-control mb-2" id="foto-lampiran" name="foto-lampiran" readonly>
                        <input type="file" class="form-control" id="foto-edit" name="foto">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-foto-edit"></div>
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
                url: '/hima/' + post_id,
                type: "GET",
                cache: false,
                success: function(response){
                    var hima = response.data;

                    // Fill form with the fetched data
                    $('#post_id').val(hima.id);
                    $('#nama-edit').val(hima.nama);
                    $('#sejarah-edit').val(hima.sejarah);
                    $('#visi-edit').val(hima.visi);
                    $('#misi-edit').val(hima.misi);
                    $('#deskripsi-edit').val(hima.deskripsi);
                    $('#foto-lampiran').val(hima.foto);

                    // Show the modal
                    $('#modal-edit').modal('show');
                }
            });
        });

        // Event handler for update button in the modal
        $('#update').click(function(e) {
            e.preventDefault();
            e.stopPropagation();

            // Reset all alert messages
            $('.alert-danger').addClass('d-none').html('');

            // Validate inputs
            let isValid = true;

            if ($('#nama-edit').val().trim() === '') {
                $('#alert-nama-edit').removeClass('d-none').html('Nama Himpunan tidak boleh kosong.');
                isValid = false;
            }
            if ($('#sejarah-edit').val().trim() === '') {
                $('#alert-sejarah-edit').removeClass('d-none').html('Sejarah Himpunan tidak boleh kosong.');
                isValid = false;
            }
            if ($('#visi-edit').val().trim() === '') {
                $('#alert-visi-edit').removeClass('d-none').html('Visi Himpunan tidak boleh kosong.');
                isValid = false;
            }
            if ($('#misi-edit').val().trim() === '') {
                $('#alert-misi-edit').removeClass('d-none').html('Misi Himpunan tidak boleh kosong.');
                isValid = false;
            }
            if ($('#deskripsi-edit').val().trim() === '') {
                $('#alert-deskripsi-edit').removeClass('d-none').html('Deskripsi Himpunan tidak boleh kosong.');
                isValid = false;
            }

            // Jika validasi gagal, hentikan pengiriman formulir
            if (!isValid) {
                return;
            }

            var post_id = $('#post_id').val();
            var formData = new FormData($('#formEditData')[0]);

            var foto = $('#foto-edit')[0].files[0];
            if (foto) {
                formData.append('foto', foto);
            }

            // Append additional data
            formData.append('_method', 'PUT');

            // Update data via AJAX
            $.ajax({
                url: '/hima/' + post_id,
                type: "POST", // Make sure the server accepts POST for updates if not using PUT
                data: formData,
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
                    let hima = `
                    <tr id="index_${response.data.id}">
                        <td style="text-align: center">${response.data.id}</td>
                        <td style="text-align: center">${response.data.nama}</td>
                        <td style="text-align: center">${response.data.sejarah}</td>
                        <td style="text-align: center">${response.data.visi}</td>
                        <td style="text-align: center">${response.data.misi}</td>
                        <td style="text-align: center">${response.data.deskripsi}</td>
                        <td><img src="{{ url('/storage/foto/') }}/${response.data.foto}" width=100 height=100></td>
                        <td class="text-center" style="padding-right:10px">
                            <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="button-edit btn btn-sm"><i class="bi bi-pencil-square me-2"></i>Edit</a>
                        </td>
                    </tr>
                    `;

                    $(`#index_${response.data.id}`).replaceWith(hima);

                    // Clear form and hide modal
                    $('#formEditData')[0].reset();
                    $('#modal-edit').modal('hide');
                },
                error: function(xhr){
                    // Parse JSON error messages
                    var err = JSON.parse(xhr.responseText);
                    if (err.errors) {
                        if (err.errors.nama) {
                            $('#alert-nama-edit').removeClass('d-none').html(err.errors.nama[0]);
                        }
                        if (err.errors.sejarah) {
                            $('#alert-sejarah-edit').removeClass('d-none').html(err.errors.sejarah[0]);
                        }
                        if (err.errors.visi) {
                            $('#alert-visi-edit').removeClass('d-none').html(err.errors.visi[0]);
                        }
                        if (err.errors.misi) {
                            $('#alert-misi-edit').removeClass('d-none').html(err.errors.misi[0]);
                        }
                        if (err.errors.deskripsi) {
                            $('#alert-deskripsi-edit').removeClass('d-none').html(err.errors.deskripsi[0]);
                        }
                        if (err.errors.foto) {
                            $('#alert-foto-edit').removeClass('d-none').html(err.errors.foto[0]);
                        }
                    }
                }
            });
        });

        // Hide alert when user starts typing
        $('#formEditData input').on('input', function() {
            $(this).next('.alert').addClass('d-none').html('');
        });

        // Hide alert when file input changes
        $('#foto-edit').on('change', function() {
            $('#alert-foto-edit').addClass('d-none').html('');
        });
    });
</script>
