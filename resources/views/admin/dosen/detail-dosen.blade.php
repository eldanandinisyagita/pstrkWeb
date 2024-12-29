<!-- Modal -->
<div class="modal fade" id="dosenDetailModal" tabindex="-1" role="dialog" aria-labelledby="dosenDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dosenDetailModalLabel">Kelola Dosen</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="dosenDetailForm" enctype="multipart/form-data" method="POST" action="{{ route('dosen.update', $dosen->id) }}">
                    @method('PUT')
                    <input type="hidden" id="post_id">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <img id="dosenFoto" src="" class="img-fluid rounded" alt="Foto Dosen">
                            <div class="form-group">
                                <label for="editFoto" class="mb-1 mt-2">Foto</label>
                                <input type="text" class="form-control mb-2" id="Fotodosen" readonly>
                                <input type="file" class="form-control d-none" id="editFoto">
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-foto"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="editNama" class="mb-1">Nama</label>
                                <input type="text" class="form-control" id="dosenNama" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                            </div>
                            <div class="form-group">
                                <label for="editNip" class="mb-1">NIP</label>
                                <input type="text" class="form-control" id="dosenNip" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nip"></div>
                            </div>
                            <div class="form-group">
                                <label for="editEmail" class="mb-1">Email</label>
                                <input type="email" class="form-control" id="dosenEmail" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email"></div>
                            </div>

                            <div class="form-group">
                                <label for="dosenLampiran" class="mb-1">Link Scholar</label>
                                <input type="text" id="dosenLampiran" class="form-control mb-2 d-none">
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-lampiran"></div>
                                <button type="button" id="scholarLink" class="btn btn-outline-primary form-control text-start">Open Scholar Link</button>
                            </div>
                            <div class="form-group">
                                <label for="dosenPddikti" class="mb-1">Link PDDIKTI</label>
                                <input type="text" id="dosenPddikti" class="form-control mb-2 d-none">
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-pddikti"></div>
                                <button type="button" id="pddiktiLink" class="btn btn-outline-primary form-control text-start">Open PDDIKTI Link</button>
                            </div>


                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="editKompetensi" class="mb-1">Kompetensi</label>
                                <textarea class="form-control" id="dosenKompetensi" rows="3" readonly></textarea>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kompetensi"></div>
                            </div>
                            <div class="form-group">
                                <label for="editMatkul" class="mb-1">Mata Kuliah</label>
                                <textarea class="form-control" id="dosenMatkul" rows="3" readonly></textarea>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-matkul"></div>
                            </div>
                            <div class="form-group">
                                <label for="editStatus" class="mb-1">Status</label>
                                <select class="form-control d-none" id="dosenStatus">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
                                <input type="text" class="form-control" id="dosenStatusText" readonly>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-status"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success float-end" id="editButton">Edit</button>
                <button type="button" class="btn btn-primary float-end me-2 d-none" id="updateButton">Save</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).on('click', '.button-detail', function() {
    var dosenId = $(this).data('id');

    // Fetch dosen data from server
    $.ajax({
        url: '/dosen/' + dosenId,
        type: 'GET',
        success: function(response) {
            var dosen = response.data;
            $('#post_id').val(dosen.id);
            $('#dosenNama').val(dosen.nama);
            $('#dosenNip').val(dosen.nip);
            $('#dosenEmail').val(dosen.email);
            $('#dosenKompetensi').val(dosen.kompetensi);
            $('#dosenMatkul').val(dosen.matkul);
            $('#dosenLampiran').val(dosen.lampiran);
            $('#dosenPddikti').val(dosen.pddikti);

            // Update button onclick attributes
            $('#scholarLink').attr('onclick', 'openLampiran("' + dosen.lampiran + '")');
            $('#pddiktiLink').attr('onclick', 'openPddikti("' + dosen.pddikti + '")');

            $('#dosenStatusText').val(dosen.status);
            $('#Fotodosen').val(dosen.foto);
            $('#dosenFoto').attr('src', '/storage/foto/' + dosen.foto);

            $('#dosenDetailModal').modal('show');
        }
    });
});

function openPddikti(url) {
    window.open(url, '_blank');
}

function openLampiran(url) {
    window.open(url, '_blank');
}

$('#editButton').click(function() {
    $('#dosenNama, #dosenNip, #dosenEmail, #dosenKompetensi, #dosenMatkul').prop('readonly', false);
    $('#dosenLampiran, #dosenPddikti').removeClass('d-none'); // Tampilkan input link
    $('#dosenStatus').removeClass('d-none');
    $('#dosenStatusText').addClass('d-none');
    $('#updateButton').removeClass('d-none');
    $('#editFoto').removeClass('d-none');
    $(this).addClass('d-none'); // Sembunyikan tombol edit
});

$('#updateButton').click(function(e) {
    e.preventDefault();
    e.stopPropagation();

    // Clear previous alerts
    $('.alert-danger').remove();

    var isValid = true;
    var dosenId = $('#post_id').val();
    var formData = new FormData();

  // Validate inputs
  if ($('#dosenNama').val().trim() === '') {
        $('#dosenNama').after('<div class="alert alert-danger">Kolom Nama tidak boleh kosong</div>');
        isValid = false;
    }
    if ($('#dosenNip').val().trim() === '') {
        $('#dosenNip').after('<div class="alert alert-danger">Kolom NIP tidak boleh kosong</div>');
        isValid = false;
    }
    var email = $('#dosenEmail').val().trim();
    if (email === '') {
        $('#dosenEmail').after('<div class="alert alert-danger">Kolom Email tidak boleh kosong</div>');
        isValid = false;
    } else if (!email.includes('@')) {
        $('#dosenEmail').after('<div class="alert alert-danger">Email harus mengandung karakter @</div>');
        isValid = false;
    }
    if ($('#dosenKompetensi').val().trim() === '') {
        $('#dosenKompetensi').after('<div class="alert alert-danger">Kolom Kompetensi tidak boleh kosong</div>');
        isValid = false;
    }
    if ($('#dosenMatkul').val().trim() === '') {
        $('#dosenMatkul').after('<div class="alert alert-danger">Kolom Mata Kuliah tidak boleh kosong</div>');
        isValid = false;
    }
    if ($('#dosenLampiran').val().trim() === '') {
        $('#dosenLampiran').after('<div class="alert alert-danger">Kolom Lampiran tidak boleh kosong</div>');
        isValid = false;
    }
    if ($('#dosenPddikti').val().trim() === '') {
        $('#dosenPddikti').after('<div class="alert alert-danger">Kolom PDDIKTI tidak boleh kosong</div>');
        isValid = false;
    }

    if (!isValid) {
        return; // Stop the submission if validation fails
    }

    var foto = $('#editFoto')[0].files[0];
    if (foto) {
        formData.append('foto', foto);
    }
    formData.append('_token', $('input[name=_token]').val());
    formData.append('_method', 'PUT');
    formData.append('nama', $('#dosenNama').val());
    formData.append('nip', $('#dosenNip').val());
    formData.append('email', $('#dosenEmail').val());
    formData.append('kompetensi', $('#dosenKompetensi').val());
    formData.append('matkul', $('#dosenMatkul').val());
    formData.append('lampiran', $('#dosenLampiran').val());
    formData.append('pddikti', $('#dosenPddikti').val());
    formData.append('status', $('#dosenStatus').val());

    $.ajax({
        url: '/dosen/' + dosenId,
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

            // Update the table row with new data
            let dosen = `
                <tr id="index_${response.data.id}">
                    <td>${response.data.id}</td>
                    <td>${response.data.nama}</td>
                    <td>${response.data.email}</td>
                    <td>${response.data.kompetensi}</td>
                    <td><a href="javascript:void(0)" class="button-detail btn btn-sm" data-id="${response.data.id}">detail</a></td>
                </tr>
            `;

            $(`#index_${response.data.id}`).replaceWith(dosen);

            $('#dosenNama, #dosenNip, #dosenEmail, #dosenKompetensi, #dosenMatkul').prop('readonly', true);
            $('#dosenLampiran, #dosenPddikti').addClass('d-none'); // Sembunyikan kembali input link
            $('#editFoto').addClass('d-none').val('');
            $('#Fotodosen').val(response.data.foto);
            $('#dosenStatusText').val(response.data.status).removeClass('d-none');
            $('#dosenStatus').addClass('d-none');
            $('#editButton').removeClass('d-none');
            $('#updateButton').addClass('d-none');

            $('#dosenDetailModal').modal('hide');
        }
    });
});

// Hide alert when typing
$('#dosenNama, #dosenNip, #dosenEmail').on('input', function() {
    $(this).next('.alert-danger').remove();
});

</script>
