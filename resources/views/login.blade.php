<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <title>Helpdesk Masuk</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/style.css" rel="stylesheet">
    </head>
    <body class="bg-login">
        <!-- Navbar -->
        <div class="navbar navbar-expand-lg fixed-top">
            <div class="container">
                <a class="navbar-brand me-auto fs-6 text-truncate" href="index.html"><b>Helpdesk</b></a>
                <!-- Login Button -->
                <div class="ms-3">
                    <a href="login.html" class="login-button ">Masuk</a>
                </div>
                <!-- End Login Button -->
                <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
        <!-- End Navbar -->
        
        <!-- Start Login Form -->
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4"><strong>Masuk</strong></h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="email" id="email" type="email" placeholder="name@example.com" />
                                                <label for="inputEmailAddress">Alamat Email</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="password" id="password" type="password" placeholder="Password" />
                                                <label for="inputPassword">Kata Sandi</label>
                                            </div>
                                            <div class="text-center">
                                                <div class="align-items-center justify-content-between mt-4 mb-3">
                                                    <button class="btn btn-primary" name="login" type="submit" href="index.html">
                                                        <span class="p-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 1 14 14">
                                                        <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708"/>
                                                        <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708"/>
                                                        </svg>
                                                        </span>
                                                    </button>
                                                </div>
                                                <div>
                                                    <a href="" class="text-decoration-none text-secondary fs-6"><strong>Lupa password?</strong></a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <!-- End Login Form -->

        <!--Footer Area Start-->
        <footer class="mt-auto">
            <div class="footer-area">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="position-absolute">Indonesia</div>
                            <div class="text-end">Copyright © 2024</div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--Footer Area End-->

         <!-- JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>
