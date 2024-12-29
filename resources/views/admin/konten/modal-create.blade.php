<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH KONTEN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="judul" class="control-label">Judul Konten</label>
                        <input type="text" class="form-control" id="judul" name="judul">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-judul"></div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi" class="control-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"></textarea>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-deskripsi"></div>
                    </div>

                    <div class="form-group">
                        <label for="tags" class="control-label">Tags</label>
                        <input type="text" class="form-control" id="tags" name="tags">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tags"></div>
                    </div>
                    <div class="form-group">
                        <label for="tgl_publish" class="control-label">Tanggal Publish</label>
                        <input type="date" class="form-control" id="tgl_publish" name="tgl_publish">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tgl_publish"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="" selected disabled>Pilih Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-status"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Lampiran</label>
                        <input type="file" class="form-control" id="lampiran" name="lampiran">
                    </div>
                    <div class="form-group">
                        <label for="jenis" class="control-label">Jenis Konten</label>
                        <select name="jenis_id" id="jenis_id" class="form-select" required>
                            @foreach($jenis_kontens as $jenis_konten)
                                <option value="{{$jenis_konten->id}}">{{$jenis_konten->jenis}}</option>
                            @endforeach
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jenis"></div>
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

            if ($('#judul').val().trim() === '') {
                $('#alert-judul').removeClass('d-none').html('Judul tidak boleh kosong.');
                isValid = false;
            }
            if ($('#deskripsi').val().trim() === '') {
                $('#alert-deskripsi').removeClass('d-none').html('Deskripsi tidak boleh kosong.');
                isValid = false;
            }
            if ($('#tags').val().trim() === '') {
                $('#alert-tags').removeClass('d-none').html('Tags tidak boleh kosong.');
                isValid = false;
            }
            if ($('#tgl_publish').val().trim() === '') {
                $('#alert-tgl_publish').removeClass('d-none').html('Tanggal publish tidak boleh kosong.');
                isValid = false;
            }
            if ($('#status').val() === null) {
                $('#alert-status').removeClass('d-none').html('Status harus dipilih.');
                isValid = false;
            }
            if ($('#jenis_id').val() === null) {
                $('#alert-jenis').removeClass('d-none').html('Jenis konten harus dipilih.');
                isValid = false;
            }
            if ($('#admin_id').val() === null) {
                $('#alert-admin_id').removeClass('d-none').html('Admin harus dipilih.');
                isValid = false;
            }

            // Jika validasi gagal, hentikan pengiriman formulir
            if (!isValid) {
                return;
            }

            var data = new FormData(this);
            data.append('judul', $('#judul').val());
            data.append('deskripsi', $('#deskripsi').val());
            data.append('tags', $('#tags').val());
            data.append('tgl_publish', $('#tgl_publish').val());
            data.append('status', $('#status').val());
            data.append('jenis_id', $('#jenis_id').val());
            data.append('admin_id', $('#admin_id').val());

            // Append lampiran file only if it is selected
            if ($('#lampiran')[0].files.length > 0) {
                data.append('lampiran', $('#lampiran')[0].files[0]);
            }

            $.ajax({
                url: '/konten', // Update the URL to the API endpoint
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

                    var lampiranHtml = '';
                    if (response.data.lampiran) {
                        var fileType = response.data.lampiran.split('.').pop().toLowerCase();
                        if (fileType === 'mp4' || fileType === 'webm' || fileType === 'ogg') {
                            lampiranHtml = `<video width="100" height="100" controls><source src="/storage/video/${response.data.lampiran}" type="video/${fileType}"></video>`;
                        } else {
                            lampiranHtml = `<img src="/storage/foto/${response.data.lampiran}" width="100" height="100">`;
                        }
                    }

                    let konten = `
                        <tr>
                            <td style="text-align: center">${response.data.id}</td>
                            <td style="text-align: center">${response.data.judul}</td>
                            <td style="text-align: center">${response.data.tags}</td>
                            <td style="text-align: center">${response.data.tgl_publish}</td>
                            <td style="text-align: center">${lampiranHtml}</td>
                            <td class="text-center" style="padding-right:10px">
                                <a href="javascript:void(0)" data-id="${response.data.id}" class="button-edit btn btn-sm"><i class="bi bi-pencil-square me-2"></i>Edit</a>
                            </td>
                        </tr>
                    `;
                    $('#table-konten').prepend(konten);

                    // Update the row numbers
                    $('#table-konten tr').each(function(index) {
                        $(this).find('td:first').text(index + 1);
                    });

                    $('#modal-create').modal('hide');
                    $('#formData')[0].reset();
                },
                error: function(error) {
                    // Handle error response
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.judul) {
                            $('#alert-judul').removeClass('d-none').html(error.responseJSON.errors.judul[0]);
                        }
                        if (error.responseJSON.errors.deskripsi) {
                            $('#alert-deskripsi').removeClass('d-none').html(error.responseJSON.errors.deskripsi[0]);
                        }
                        if (error.responseJSON.errors.tags) {
                            $('#alert-tags').removeClass('d-none').html(error.responseJSON.errors.tags[0]);
                        }
                        if (error.responseJSON.errors.tgl_publish) {
                            $('#alert-tgl_publish').removeClass('d-none').html(error.responseJSON.errors.tgl_publish[0]);
                        }
                        if (error.responseJSON.errors.status) {
                            $('#alert-status').removeClass('d-none').html(error.responseJSON.errors.status[0]);
                        }
                        if (error.responseJSON.errors.lampiran) {
                            $('#alert-lampiran').removeClass('d-none').html(error.responseJSON.errors.lampiran[0]);
                        }
                        if (error.responseJSON.errors.jenis_id) {
                            $('#alert-jenis').removeClass('d-none').html(error.responseJSON.errors.jenis_id[0]);
                        }
                        if (error.responseJSON.errors.admin_id) {
                            $('#alert-admin_id').removeClass('d-none').html(error.responseJSON.errors.admin_id[0]);
                        }
                    }
                }
            });
        });

        // Hide alerts when the user starts typing or changes file input
        $('#judul, #deskripsi, #tags, #tgl_publish, #status, #jenis_id, #admin_id').on('input change', function() {
            $(this).next('.alert-danger').addClass('d-none').html('');
        });

        $('#lampiran').on('change', function() {
            $('#alert-lampiran').addClass('d-none').html('');
        });
    });
</script>
