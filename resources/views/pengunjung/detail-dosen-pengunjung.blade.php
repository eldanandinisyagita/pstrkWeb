<!-- Modal -->
<div class="modal fade" id="dosenDetailModal" tabindex="-1" role="dialog" aria-labelledby="dosenDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl align-center" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dosenDetailModalLabel">Detail Dosen</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <img id="dosenFoto" src="" class="img-fluid rounded" alt="Foto Dosen">
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="mb-1 fw-semibold">Nama:</label>
                            <p class="text-black" id="dosenNama"></p>
                        </div>
                        <div class="form-group">
                            <label class="mb-1 fw-semibold">NIP:</label>
                            <p class="text-black" id="dosenNip"></p>
                        </div>
                        <div class="form-group">
                            <label class="mb-1 fw-semibold">Email:</label>
                            <p class="text-black" id="dosenEmail"></p>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" style="margin-right: 20px" id="dosenPddikti" onclick="openPddikti()">Lihat PDDIKTI</button>
                            <button class="btn btn-primary" id="dosenLampiran" onclick="openLampiran()">Lihat Publikasi</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="mb-1 fw-semibold">Kompetensi:</label>
                            <p class="text-black" id="dosenKompetensi"></p>
                        </div>
                        <div class="form-group">
                            <label class="mb-1 fw-semibold">Mata Kuliah:</label>
                            <p class="text-black" id="dosenMatkul"></p>
                        </div>

                    </div>
                </div>
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
                $('#dosenNama').text(dosen.nama);
                $('#dosenNip').text(dosen.nip);
                $('#dosenEmail').text(dosen.email);
                $('#dosenKompetensi').text(dosen.kompetensi);
                $('#dosenMatkul').text(dosen.matkul);
                $('#dosenFoto').attr('src', '/storage/foto/' + dosen.foto);

                // Update button href
                $('#dosenPddikti').attr('onclick', 'openPddikti("' + dosen.pddikti + '")');
                $('#dosenLampiran').attr('onclick', 'openLampiran("' + dosen.lampiran + '")');

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
</script>
