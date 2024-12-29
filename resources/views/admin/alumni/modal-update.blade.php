<!-- Modal Detail/Edit Alumni -->
<div class="modal fade" id="modalDetailAlumni" tabindex="-1" role="dialog" aria-labelledby="modalDetailAlumniLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailAlumniLabel">Kelola Data Alumni</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formDetailAlumni" enctype="multipart/form-data" method="POST" action="{{ route('alumni.update', $alumni->id) }}">
                    @method('PUT')
                    @csrf
                    <input type="hidden" id="post_id">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_detail" class="control-label">Nama Alumni</label>
                                <input type="text" class="form-control" id="nama_detail" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama_detail"></div>
                            </div>
                            <div class="form-group">
                                <img id="fotoDetail" src="" class="img-thumbnail rounded">
                                <label for="foto_detail" class="control-label">Foto</label>
                                <input type="text" class="form-control mb-2" id="foto_detail" readonly>
                                <input type="file" class="form-control d-none" id="editFoto" name="foto">
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-foto_detail"></div>
                            </div>

                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="generasi_detail" class="control-label">Generasi</label>
                                <input type="text" class="form-control" id="generasi_detail" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-generasi_detail"></div>
                            </div>
                            <div class="form-group">
                                <label for="kompetensi_detail" class="control-label">Kompetensi</label>
                                <input type="text" class="form-control" id="kompetensi_detail" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kompetensi_detail"></div>
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan_detail" class="control-label">Pekerjaan</label>
                                <input type="text" class="form-control" id="pekerjaan_detail" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-pekerjaan_detail"></div>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_detail" class="control-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi_detail" rows="4" readonly></textarea>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-deskripsi_detail"></div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="editAlumniButton">Edit</button>
                <button type="button" class="btn btn-primary d-none" id="saveAlumniChanges">Save</button>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).on('click', '.button-detail', function() {
        var alumniId = $(this).data('id');

        // Fetch alumni data from the server
        $.ajax({
            url: '/alumni/' + alumniId,
            type: 'GET',
            success: function(response) {
                var alumni = response.data;

                // Populate data in the modal
                $('#post_id').val(alumni.id);
                $('#nama_detail').val(alumni.nama);
                $('#generasi_detail').val(alumni.generasi);
                $('#pekerjaan_detail').val(alumni.pekerjaan);
                $('#deskripsi_detail').val(alumni.deskripsi);
                $('#kompetensi_detail').val(alumni.kompetensi);
                $('#foto_detail').val(alumni.foto);
                $('#fotoDetail').attr('src', '/storage/foto/' + alumni.foto);

                // Show modal
                $('#modalDetailAlumni').modal('show');
            }
        });
    });

    // Enable edit mode on "Edit" button click
    $('#editAlumniButton').click(function() {
        $('#nama_detail, #generasi_detail, #pekerjaan_detail, #deskripsi_detail, #kompetensi_detail').prop('readonly', false);

        // Show file input and save button
        $('#editFoto').removeClass('d-none');
        $('#saveAlumniChanges').removeClass('d-none');
        $(this).addClass('d-none');
    });

    // Save changes on "Save" button click
    $('#saveAlumniChanges').click(function(e) {
        e.preventDefault();
        e.stopPropagation();

       // Clear previous alerts
        $('.alert-danger').remove();

        var isValid = true;
        var alumniId = $('#post_id').val();
        var formData = new FormData();

        // Validation
        $('.alert-danger').addClass('d-none');
        if ($('#nama_detail').val().trim() === '') {
            $('#alert-nama_detail').removeClass('d-none').html('Kolom Nama tidak boleh kosong');
            isValid = false;
        }
        if ($('#generasi_detail').val().trim() === '') {
            $('#alert-generasi_detail').removeClass('d-none').html('Kolom Generasi tidak boleh kosong');
            isValid = false;
        }
        if ($('#pekerjaan_detail').val().trim() === '') {
            $('#alert-pekerjaan_detail').removeClass('d-none').html('Kolom Pekerjaan tidak boleh kosong');
            isValid = false;
        }
        if ($('#deskripsi_detail').val().trim() === '') {
            $('#alert-deskripsi_detail').removeClass('d-none').html('Kolom Deskripsi tidak boleh kosong');
            isValid = false;
        }
        if ($('#kompetensi_detail').val().trim() === '') {
            $('#alert-kompetensi_detail').removeClass('d-none').html('Kolom Kompetensi tidak boleh kosong');
            isValid = false;
        }

        if (!isValid) {
        return; // Stop the submission if validation fails
    }

        // Add data to formData
        formData.append('_token', $('input[name=_token]').val());
        formData.append('_method', 'PUT');
        formData.append('nama', $('#nama_detail').val());
        formData.append('generasi', $('#generasi_detail').val());
        formData.append('pekerjaan', $('#pekerjaan_detail').val());
        formData.append('deskripsi', $('#deskripsi_detail').val());
        formData.append('kompetensi', $('#kompetensi_detail').val());

        if ($('#editFoto')[0].files[0]) {
            formData.append('foto', $('#editFoto')[0].files[0]);
        }

        $.ajax({
            url: '/alumni/' + alumniId,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });

                // Update table row data
                let row = $(`.button-detail[data-id="${alumniId}"]`).closest('tr');
                row.find('td:eq(1)').text(response.data.nama);
                row.find('td:eq(2)').text(response.data.generasi);
                row.find('td:eq(3)').text(response.data.pekerjaan);
                row.find('td:eq(4)').html(`<img src="/storage/foto/${response.data.foto}" width="100" height="100">`);

                // Close modal and reset form to readonly mode
                $('#modalDetailAlumni').modal('hide');
                $('#nama_detail, #generasi_detail, #pekerjaan_detail, #deskripsi_detail, #kompetensi_detail').prop('readonly', true);
                $('#editAlumniButton').removeClass('d-none');
                $('#saveAlumniChanges').addClass('d-none');
                $('#editFoto').addClass('d-none');

                // Update row numbers
                updateRowNumbers();
            }
        });
    });

    // Function to update row numbers in the table
    function updateRowNumbers() {
        $('#table-alumis tr').each(function(index) {
            $(this).find('.row-index').text(index + 1);
        });
    }

    // Remove validation alert on input
    $('#nama_detail, #generasi_detail, #pekerjaan_detail, #deskripsi_detail, #kompetensi_detail').on('input', function() {
        $(this).next('.alert-danger').addClass('d-none');
    });
</script>
