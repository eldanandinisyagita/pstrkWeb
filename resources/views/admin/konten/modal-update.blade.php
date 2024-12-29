<!-- Modal Detail/Edit Konten -->
<div class="modal fade" id="modalDetailKonten" tabindex="-1" role="dialog" aria-labelledby="modalDetailKontenLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailKontenLabel">Kelola Konten</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formDetailKonten" enctype="multipart/form-data" method="POST" action="{{ route('konten.update', $konten->id) }}">
                    @method('PUT')
                    <input type="hidden" id="konten_id">
                    @csrf
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="judul_detail" class="control-label">Judul Konten</label>
                                <input type="text" class="form-control" id="judul_detail" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-judul_detail"></div>
                            </div>
                            <div class="form-group">
                                <label for="tgl_publish_detail" class="control-label">Tanggal Publish</label>
                                <input type="date" class="form-control" id="tgl_publish_detail" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tgl_publish_detail"></div>
                            </div>
                            <div class="form-group">
                                <img id="lampiranFoto" src="" class="img-thumbnail rounded" >
                                <label for="lampiran_detail" class="control-label">Lampiran</label>
                                <input type="text" class="form-control mb-2" id="lampiran_detail" readonly>
                                <input type="file" class="form-control d-none" id="editLampiran" name="lampiran">
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-lampiran_detail"></div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="deskripsi_detail" class="control-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi_detail" rows="4" readonly></textarea>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-deskripsi_detail"></div>
                            </div>

                            <div class="form-group">
                                <label for="jenis_detail" class="control-label">Jenis Konten</label>

                                <!-- Input readonly untuk mode baca-saja -->
                                <input type="text" class="form-control" id="jenis_detail_text" readonly>

                                <!-- Select option untuk mode edit -->
                                <select name="jenis_id" id="jenis_detail_select" class="form-select d-none">
                                    @foreach($jenis_kontens as $jenis_konten)
                                        <option value="{{ $jenis_konten->id }}">{{ $jenis_konten->jenis }}</option>
                                    @endforeach
                                </select>

                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jenis_detail"></div>
                            </div>

                            <div class="form-group">
                                <label for="tags_detail" class="control-label">Tags</label>
                                <input type="text" class="form-control" id="tags_detail" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tags_detail"></div>
                            </div>
                            <div class="form-group">
                                <label for="status_detail" class="control-label">Status</label>
                                <select class="form-select d-none" id="status_detail_select">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
                                <input type="text" class="form-control" id="status_detail_text" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-status_detail"></div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="editKontenButton">Edit</button>
                <button type="button" class="btn btn-primary d-none" id="saveKontenChanges">Save</button>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).on('click', '.button-detail', function() {
        var kontenId = $(this).data('id');

        // Fetch konten data from the server
        $.ajax({
            url: '/konten/' + kontenId,
            type: 'GET',
            success: function(response) {
                var konten = response.data;

                // Populate data in the modal
                $('#konten_id').val(konten.id);
                $('#judul_detail').val(konten.judul);
                $('#deskripsi_detail').val(konten.deskripsi);
                $('#tags_detail').val(konten.tags);
                $('#tgl_publish_detail').val(konten.tgl_publish);
                $('#status_detail_text').val(konten.status);

                $('#jenis_detail_text').val($('#jenis_detail_select option[value="'+ konten.jenis_id +'"]').text());
                $('#jenis_detail_select').val(konten.jenis_id);
                $('#lampiran_detail').val(konten.lampiran);
                $('#lampiranFoto').attr('src', '/storage/foto/' + konten.lampiran);

                // Show modal
                $('#modalDetailKonten').modal('show');
            }
        });
    });

    // Enable edit mode on "Edit" button click
    $('#editKontenButton').click(function() {
        $('#judul_detail, #deskripsi_detail, #tags_detail, #tgl_publish_detail').prop('readonly', false);

        // Show select options for jenis and status fields
        $('#jenis_detail_text').addClass('d-none');
        $('#jenis_detail_select').removeClass('d-none');
        $('#status_detail_text').addClass('d-none');
        $('#status_detail_select').removeClass('d-none');

        $('#editLampiran').removeClass('d-none'); // Enable file upload
        $('#saveKontenChanges').removeClass('d-none'); // Show "Save" button
        $(this).addClass('d-none'); // Hide "Edit" button
    });

    // Save changes on "Save" button click
    $('#saveKontenChanges').click(function(e) {
        e.preventDefault();
        e.stopPropagation();

        var isValid = true;
        var kontenId = $('#konten_id').val();
        var formData = new FormData();

        // Validation
        $('.alert-danger').remove();
        if ($('#judul_detail').val().trim() === '') {
            $('#judul_detail').after('<div class="alert alert-danger">Kolom Judul tidak boleh kosong</div>');
            isValid = false;
        }
        if ($('#deskripsi_detail').val().trim() === '') {
            $('#deskripsi_detail').after('<div class="alert alert-danger">Kolom Deskripsi tidak boleh kosong</div>');
            isValid = false;
        }
        if ($('#tags_detail').val().trim() === '') {
            $('#tags_detail').after('<div class="alert alert-danger">Kolom Tags tidak boleh kosong</div>');
            isValid = false;
        }
        if ($('#tgl_publish_detail').val().trim() === '') {
            $('#tgl_publish_detail').after('<div class="alert alert-danger">Kolom Tanggal Publish tidak boleh kosong</div>');
            isValid = false;
        }

        if (!isValid) {
        return; // Hentikan jika validasi gagal
    }

        // Add data to formData
        formData.append('_token', $('input[name=_token]').val());
        formData.append('_method', 'PUT');
        formData.append('judul', $('#judul_detail').val());
        formData.append('deskripsi', $('#deskripsi_detail').val());
        formData.append('tags', $('#tags_detail').val());
        formData.append('tgl_publish', $('#tgl_publish_detail').val());
        formData.append('status', $('#status_detail_select').val());
        formData.append('jenis_id', $('#jenis_detail_select').val());

        if ($('#editLampiran')[0].files[0]) {
            formData.append('lampiran', $('#editLampiran')[0].files[0]);
        }

        $.ajax({
            url: '/konten/' + kontenId,
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
                 let row = $(`.button-detail[data-id="${kontenId}"]`).closest('tr');
                row.find('td:eq(1)').text(response.data.judul);
                row.find('td:eq(2)').text(response.data.tags);
                row.find('td:eq(3)').html(`<img src="/storage/foto/${response.data.lampiran}" width="100" height="100">`);

                 // Close modal and reset form to readonly mode
                $('#modalDetailKonten').modal('hide');
                $('#judul_detail, #deskripsi_detail, #tags_detail, #tgl_publish_detail').prop('readonly', true);
                $('#status_detail_text').removeClass('d-none').val($('#status_detail_select').val());
                $('#status_detail_select').addClass('d-none');
                $('#jenis_detail_text').removeClass('d-none').val($('#jenis_detail_select option:selected').text());
                $('#jenis_detail_select').addClass('d-none');
                $('#editLampiran').addClass('d-none');
                $('#editKontenButton').removeClass('d-none');
                $('#saveKontenChanges').addClass('d-none');


                // Update row numbers
                updateRowNumbers();
            }
        });
    });

    // Function to update row numbers in the table
    function updateRowNumbers() {
        $('#table-konten tr').each(function(index) {
            $(this).find('.row-index').text(index + 1);
        });
    }

    // Remove validation alert on input
    $('#judul_detail, #deskripsi_detail, #tags_detail, #tgl_publish_detail').on('input', function() {
        $(this).next('.alert-danger').remove();
    });
</script>
