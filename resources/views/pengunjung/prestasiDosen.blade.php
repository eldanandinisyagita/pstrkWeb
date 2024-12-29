<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Website PSTRK</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

    <header id="header" class="header sticky-top">

        <div class="branding d-flex align-items-cente">

          <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="/pengunjung" class="logo d-flex align-items-center">
                <img src="assets/img/logoTRK.png" alt="PSTRK Logo" style="height: 40px; margin-right: 20px;">
                <h1 class="sitename">PSTRK</h1>
            </a>

            <nav id="navmenu" class="navmenu">
              <ul>
                <li><a href="/pengunjung" >Beranda</a></li>
                <li class="dropdown"><a href=""><span>Profil</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                  <ul>
                    <li><a href="profilPengunjung">Profil Singkat</a></li>
                    <li><a href="dosenPengunjung">Pengajar</a></li>
                    <li><a href="alumniPengunjung">Prospek Alumni</a></li>
                    <li><a href="himaPengunjung">Himpunan Mahasiswa</a></li>
                  </ul>
                </li>
                <li class="dropdown"><a href=""><span>Akademik</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                      <li><a href="/kurikulumPengunjung">Kurikulum</a></li>
                      <li><a href="/akreditasiPengunjung">Akreditasi</a></li>
                      <li><a href="/fasilitasPengunjung">Fasilitas</a></li>
                    </ul>
                  </li>
                  <li class="dropdown"><a href="" class="active"><span>Berita & Prestasi</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                      <li><a href="/beritaDosen">Berita Dosen</a></li>
                      <li><a href="/beritaMhs">Berita Mahasiswa</a></li>
                      <li><a href="/prestasiDosen">Prestasi Dosen</a></li>
                      <li><a href="/prestasiMhs">Prestasi Mahasiswa</a></li>
                    </ul>
                  </li>
                  <li class="dropdown"><a href=""><span>Dokumentasi</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                      <li><a href="/kegiatanDosen">Kegiatan Dosen</a></li>
                      <li><a href="/kegiatanMhs">Kegiatan Mahasiswa</a></li>
                      <li><a href="/fotoPengunjung">Foto</a></li>
                      <li><a href="/videoPengunjung">Video</a></li>
                    </ul>
                  </li>
                <li><a href="/faqPengunjung">FAQ</a></li>
              </ul>
              <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

          </div>

        </div>

    </header>

    <main class="main">
        <!-- Slideshow -->
        <section id="vidio" class="akreditasi">
            <div class="container">
                <div id="prestasiCarousel" class="carousel slide " data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($prestasis as $index => $prestasi)
                        <div class="presdos-carousel-item carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ url('storage/foto/'.$prestasi->lampiran) }}" alt="Prestasi Image">
                            <div class="presdos-carousel-caption carousel-caption p-3">
                                <h5 class="text-light fw-bold">{{ $prestasi->judul }}</h5>

                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#prestasiCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#prestasiCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <div class="container mt-5">
                    <div class="row">
                        <!-- Prestasi Dosen -->
                        <div class="col-8">
                            <div class="mb-4 pembatas-prestasi2">
                                <h5 class="text-pembatas-prestasi">Prestasi Terbaru</h5>
                                <img src="assets/img/line 24.png" alt="">
                            </div>

                            <div id="prestasi-container" class="mb-4">
                                @foreach ($prestasis as $prestasi)
                                <a href="{{ route('detail-prestasi', $prestasi->id) }}" class="card-link">
                                    <div class="card prestasi-card2">
                                        <img src="{{ url('/storage/foto/'.$prestasi->lampiran) }}" class="img-fluid" alt="Main Image">
                                        <div class="card-body prestasi-card-content2">
                                            <p class="judul-pres">{{ $prestasi->judul }}</p>
                                            <p class="text-muted mt-0 tgl-pres">{{ $prestasi->formatted_tgl_publish }}</p>
                                            <p class="deskpres">{{ $prestasi->deskripsi }}</p>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>

                            @if($prestasis->hasMorePages())
                                <div class="text-center">
                                    <button id="load-more-prestasi" data-page="2" class="btn btn-load">Prestasi lainnya</button>
                                </div>
                            @endif

                            <script>
                                document.getElementById('load-more-prestasi').addEventListener('click', function() {
                                    let button = this;
                                    let page = button.getAttribute('data-page');

                                    fetch(`/prestasiDosen?page=${page}`, {
                                        headers: {
                                            'X-Requested-With': 'XMLHttpRequest'
                                        }
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        let container = document.getElementById('prestasi-container');

                                        // Append new data to the container
                                        data.data.forEach(prestasi => {
                                            let prestasiItem = document.createElement('a');
                                            prestasiItem.href = `/detail-prestasi/${prestasi.id}`;
                                            prestasiItem.classList.add('card-link');
                                            prestasiItem.innerHTML = `
                                                <div class="card prestasi-card2">
                                                    <img src="${prestasi.lampiran_url}" class="img-fluid" alt="Main Image">
                                                    <div class="card-body prestasi-card-content2">
                                                        <p class="judul-pres">${prestasi.judul}</p>
                                                        <p class="text-muted mt-0 tgl-pres">${prestasi.formatted_tgl_publish}</p>
                                                        <p class="deskpres">${prestasi.deskripsi}</p>
                                                    </div>
                                                </div>
                                            `;
                                            container.appendChild(prestasiItem);
                                        });

                                        // Update to the next page
                                        button.setAttribute('data-page', parseInt(page) + 1);

                                        // Hide the button if there are no more pages
                                        if (!data.next_page_url) {
                                            button.style.display = 'none';
                                        }
                                    })
                                    .catch(error => console.error('Error loading more data:', error));
                                });
                            </script>
                        </div>


                        <!-- Prestasi Terbaru -->
                        <div class="col-3 ms-5 p-0">
                            <div class="row mb-4">
                                <div class=" mb-4 pembatas-prestasi2kecil">
                                    <h5 class="text-pembatas-prestasi">Prestasi Lainnya</h5>
                                    <img src="assets/img/line 29.png" alt="">
                                </div>
                                <ul class="presdos-latest-list">
                                    @foreach($prestasis as $prestasi)
                                    <li class="border-bottom">
                                        <p class="mb-2"><a href="{{ route('detail-prestasi', $prestasi->id) }}">{{ $prestasi->judul }}</a></p>
                                        <small class="d-block mb-2">{{ $prestasi->formatted_tgl_publish }}</small>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="row">
                                <div class=" mb-4 ms-0 pembatas-prestasi2kecil">
                                    <h5 class="text-pembatas-prestasi">Agenda</h5>
                                    <img src="assets/img/line 29.png" alt="">
                                </div>
                                <ul class="presdos-latest-list">
                                    @foreach($agendas as $agenda)
                                    <li class="border-bottom">
                                        <p class="mb-2">{{ $agenda->judul }}</p>
                                        <small class="d-block mb-2">{{ $agenda->formatted_tgl_mulai }} | {{ $agenda->penyelenggara }}</small>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /prestasi Section -->
    </main>

  <footer id="footer" class="footer">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-3 col-md-3 footer-about border-end">
          <a href="" class="d-flex align-items-center">
            <span class="d-none d-lg-block text-light fs-1 ">P S T R K</span>
          </a>
        </div>

        <div class="col-lg-3 col-md-3 footer-links border-end ">
          <h4 class="text-light">Alamat</h4>
          <ul class="pe-4">
            @foreach($kontaks as $kontak)
                @if($kontak->jenis_kontak == 'Alamat')
                    <li>
                        <img src="assets/img/loc.png" alt="" width="26" height="26" class="me-2 mt-2 align-self-start">
                        <p class="text-break alamat">{{ $kontak->kontak }}</p>
                    </li>
                @endif
            @endforeach
        </ul>

        </div>

        <div class="col-lg-3 col-md-3 footer-links border-end" >
          <h4 class="text-light">Kontak</h4>
          <ul>
            @foreach($kontaks as $kontak)
                @if($kontak->jenis_kontak == 'Telepon')
                    <li style="text-align: center">
                        <img src="assets/img/telpon.webp" alt="" width="24" height="24" class="me-2">
                         {{ $kontak->kontak }}
                    </li>
                @elseif($kontak->jenis_kontak == 'whatsapp')
                    <li style="text-align: center">
                        <img src="assets/img/wa.png" alt="" width="24" height="24" class="me-2">
                        <a href="{{ $kontak->kontak }}" class="text-light" target="_blank">Whatsapp Admin</a>
                    </li>
                @elseif($kontak->jenis_kontak == 'Email')
                    <li style="text-align: center">
                        <img src="assets/img/mail.png" alt="" width="24" height="24" class="me-2">
                        {{ $kontak->kontak }}
                    </li>
                @endif
            @endforeach
        </ul>


        </div>

        <div class="col-lg-3 col-md-12">
          <h4 class="text-light">Media Sosial</h4>
          <ul class="p-0 m-0">
            @foreach($kontaks as $kontak)
                @if($kontak->jenis_kontak == 'Youtube')
                    <li style="list-style: none" class="mb-2">
                        <img src="assets/img/youtube.png" alt="" width="24" height="24" class="m-1">
                        <a href="{{ $kontak->kontak }}" class="text-light" target="_blank">PSTRK Hebat</a>
                    </li>
                @elseif($kontak->jenis_kontak == 'Facebook')
                    <li style="list-style: none" class="mb-2">
                        <img src="assets/img/fb.png" alt="" width="24" height="24" class="m-1">
                        <a href="{{ $kontak->kontak }}" class="text-light" target="_blank">PSTRK PCR</a>
                    </li>
                @elseif($kontak->jenis_kontak == 'Instagram' && strpos($kontak->kontak, 'hima') !== false)
                    <li style="list-style: none" class="mb-2">
                        <img src="assets/img/instagram.png" alt="" width="24" height="24" class="m-1">
                        <a href="{{ $kontak->kontak }}" class="text-light" target="_blank">@himakom_pcr</a>
                    </li>
                @elseif($kontak->jenis_kontak == 'Instagram' && strpos($kontak->kontak, 'hebat') !== false)
                    <li style="list-style: none" class="mb-2">
                        <img src="assets/img/instagram.png" alt="" width="24" height="24" class="m-1">
                        <a href="{{ $kontak->kontak }}" class="text-light" target="_blank">@pstrk_hebat</a>
                    </li>
                @endif
            @endforeach
        </ul>



        </div>

      </div>
    </div>
  </footer>




    <!-- Pop-up Button dengan Tooltip -->
    <button class="btn btn-lg btn-pesan fixed-button" id="btn-create-post" data-bs-toggle="tooltip" data-bs-placement="left" title="Klik untuk mengirim pesan" data-toggle="modal" data-target="#pesanModal">
        <i class="bi bi-envelope"></i>
    </button>

    <!-- Modal Structure -->
    <div class="modal fade" id="pesanModal" tabindex="-1" aria-labelledby="pesanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formData" method="post" action="{{ route('pesan.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="pesanModalLabel">Kirim Pesan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required data-bs-toggle="tooltip" data-bs-placement="top" title="Masukkan email yang valid">
                        </div>

                        <div class="form-group">
                            <label for="isi_pesan">Pesan</label>
                            <textarea class="form-control" id="isi_pesan" name="isi_pesan" rows="4" required data-bs-toggle="tooltip" data-bs-placement="top" title="Tulis pesan Anda di sini"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mt-3">Kirim</button>
                        <div id="alert-email" class="alert alert-danger d-none"></div>
                        <div id="alert-isi_pesan" class="alert alert-danger d-none"></div>
                    </div>
                    <div class="modal-footer d-block">
                        <hr>
                        <div class="text-center mt-3">
                            atau hubungi melalui
                        </div>
                        <div class="text-center mt-3">
                            @foreach($kontaks as $kontak)
                            @if($kontak->jenis_kontak == 'whatsapp')
                            <a href="{{ $kontak->kontak }}" target="_blank">
                                <img src="assets/img/wa.png" alt="" width="30" height="30" class="me-2">
                                Whatsapp Prodi
                            </a>
                            @elseif($kontak->jenis_kontak == 'Email' && strpos($kontak->kontak, 'pstrk@') !== false)
                            <a href="{{ $kontak->kontak }}" target="_blank" class="ms-3">
                                <img src="assets/img/mail.png" alt="" width="30" height="30" class="me-2">
                                Email Prodi
                            </a>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


  <!-- jQuery and Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

  <!-- Swal JS for alerts -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
           $(document).ready(function () {
            // Mengaktifkan tooltip untuk semua elemen dengan atribut 'data-bs-toggle="tooltip"'
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);  // Menggunakan bootstrap.Tooltip untuk menginisialisasi tooltip
            });

            $('#formData').on('submit', function (e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: '/pesan',
                    type: 'POST',
                    data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Pesan berhasil dikirim',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        $('#pesanModal').modal('hide');
                        $('#formData')[0].reset();
                        $('#alert-email, #alert-isi_pesan').addClass('d-none');
                        setTimeout(() => {
                            window.location.href = "/prestasiDosen";
                        }, 500);
                    });
                },
                error: function (xhr) {
                    var errors = xhr.responseJSON.errors;
                    if (errors.email) {
                        $('#alert-email').removeClass('d-none').text(errors.email[0]);
                    } else {
                        $('#alert-email').addClass('d-none');
                    }

                    if (errors.isi_pesan) {
                        $('#alert-isi_pesan').removeClass('d-none').text(errors.isi_pesan[0]);
                    } else {
                        $('#alert-isi_pesan').addClass('d-none');
                    }
                }
            });
        });
    });
  </script>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="../assets/js/main2.js"></script>

{{-- <!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> --}}
</body>

</html>

