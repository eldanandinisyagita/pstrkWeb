<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Register - PSTRK</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body class="bg-login">
    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center pt-4">
                                <h5 class="text-white fw-bolder fs-2 label-selamat">BUAT AKUN</h5>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <form class="row g-3 needs-validation" novalidate id="registerForm">
                                        @csrf
                                        <div class="col-12">
                                            <label for="yourName" class="form-label">Nama</label>
                                            <input type="text" name="fakeName" class="form-control" id="fakeName" required autocomplete="new-password" placeholder="Silahkan isi nama">
                                            <div class="invalid-feedback">Please enter your name.</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourEmail" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="fakeEmail" class="form-control" id="fakeEmail" required autocomplete="new-password" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" oninput="setCustomValidity('')" placeholder="Isi email menggunakan @">
                                                <div class="invalid-feedback">Please enter a valid email address.</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="fakePassword" class="form-control" id="fakePassword" required minlength="8" autocomplete="new-password" placeholder="Isi 8 karakter">
                                            <div class="invalid-feedback">Password must be at least 8 characters long.</div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-register w-100" type="submit">Register</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Sudah punya akun? <a href="/">Login</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        const CSRF_TOKEN = document.querySelector("meta[name='csrf-token']").getAttribute("content");

        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const name = document.getElementById('fakeName').value;
            const email = document.getElementById('fakeEmail').value;
            const password = document.getElementById('fakePassword').value;

            // Client-side validation for password length
            if (password.length < 8) {
                alert('Password must be at least 8 characters long.');
                return;
            }

            axios.post('/register', {
                name: name,
                email: email,
                password: password,
                _token: CSRF_TOKEN
            })
            .then(function(response) {
                if (response.data.success) {
                    // Arahkan langsung ke halaman login tanpa alert
                    window.location.href = '/';
                } else {
                    alert('Registration failed: ' + response.data.message);
                }
            })
            .catch(function(error) {
                alert('An error occurred: ' + error.response.data.message);
            });
        });
    </script>

</body>

</html>
