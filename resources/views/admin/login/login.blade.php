<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Pages / Login - PSTRK</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- Custom CSS untuk menonaktifkan checkmark -->
    <style>
        /* Hapus tanda checkmark pada input valid */
        input:valid {
            box-shadow: none !important;
        }

        /* Nonaktifkan ikon validasi pada elemen input */
        input.form-control:valid {
            background-image: none !important;
        }
    </style>
</head>


<body class="bg-login">
    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center pt-4">
                                <h5 class="text-white fw-bolder fs-2 label-selamat">SELAMAT DATANG</h5>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <form class="row g-3 needs-validation" novalidate id="loginForm">
                                        @csrf
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="email" name="email" class="form-control" id="email" required>
                                                <div class="invalid-feedback" id="emailError">Email tidak boleh kosong.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="password" required>
                                            <div class="invalid-feedback" id="passwordError">Password tidak boleh kosong.</div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-login w-100" type="submit">Login</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Tidak memiliki akun? <a href="/register">Buat akun</a></p>
                                        </div>
                                    </form>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>
        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <script>
        const CSRF_TOKEN = document.querySelector("meta[name='csrf-token']").getAttribute("content");

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Ambil nilai dari input email dan password
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();

            // Ambil elemen untuk pesan error
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');

            // Reset pesan error
            emailError.style.display = 'none';
            passwordError.style.display = 'none';
            document.getElementById('email').classList.remove('is-invalid');
            document.getElementById('password').classList.remove('is-invalid');

            // Validasi input email dan password
            let isValid = true;
            if (email === "") {
                emailError.style.display = 'block';
                document.getElementById('email').classList.add('is-invalid');
                isValid = false;
            }
            if (password === "") {
                passwordError.style.display = 'block';
                document.getElementById('password').classList.add('is-invalid');
                isValid = false;
            }

            // Jika validasi gagal, hentikan proses
            if (!isValid) return;

            // Jika validasi berhasil, kirim data menggunakan axios
            axios.post('/login', {
                email: email,
                password: password,
                _token: CSRF_TOKEN
            })
            .then(function(response) {
                if (response.data.success) {
                    // Jika login berhasil
                    var access_token = response.data.data.token;
                    setCookie('access_token', access_token, 2);
                    window.location.href = '/dashboard';
                } else {
                    // Jika login gagal dan email tidak terdaftar
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Gagal',
                        text: 'Email tidak terdaftar atau salah!',
                        confirmButtonText: 'Coba Lagi',
                    });
                }
            })
            .catch(function(error) {
                // Tangani error lain (misal server tidak merespon)
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: error.response?.data?.message || 'Silakan coba lagi.',
                    confirmButtonText: 'Coba Lagi',
                });
            });
        });

        // Fungsi untuk menyimpan token dalam cookie
        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }
    </script>


</body>

</html>
