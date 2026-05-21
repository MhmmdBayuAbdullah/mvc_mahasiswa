<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        <?= isset($title) ? $title : 'MVC Mahasiswa'; ?>
    </title>

    <!-- Bootstrap 5 CDN -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <div class="container">

            <a
                class="navbar-brand"
                href="<?= BASEURL; ?>"
            >
                MVC Mahasiswa
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div
                class="collapse navbar-collapse"
                id="navbarNav"
            >

                <ul class="navbar-nav me-auto">

                    <!-- HOME -->
                    <li class="nav-item">

                        <a
                            class="nav-link"
                            href="<?= BASEURL; ?>"
                        >
                            Home
                        </a>

                    </li>

                    <?php if (isset($_SESSION['user'])) : ?>

                        <!-- DATA MAHASISWA -->
                        <li class="nav-item">

                            <a
                                class="nav-link"
                                href="<?= BASEURL; ?>/mahasiswa/index"
                            >
                                Data Mahasiswa
                            </a>

                        </li>

                        <!-- KHUSUS ADMIN -->
                        <?php if ($_SESSION['user']['role'] == 'admin') : ?>

                            <li class="nav-item">

                                <a
                                    class="nav-link"
                                    href="<?= BASEURL; ?>/mahasiswa/create"
                                >
                                    Tambah Mahasiswa
                                </a>

                            </li>

                        <?php endif; ?>

                    <?php endif; ?>

                </ul>

                <!-- USER LOGIN -->
                <ul class="navbar-nav">

                    <?php if (isset($_SESSION['user'])) : ?>

                        <li class="nav-item">

                            <span class="nav-link text-warning">

                                Login sebagai:
                                <?= $_SESSION['user']['username']; ?>

                                (
                                <?= $_SESSION['user']['role']; ?>
                                )

                            </span>

                        </li>

                        <li class="nav-item">

                            <a
                                class="nav-link text-danger"
                                href="<?= BASEURL; ?>/auth/logout"
                            >
                                Logout
                            </a>

                        </li>

                    <?php else : ?>

                        <li class="nav-item">

                            <a
                                class="nav-link"
                                href="<?= BASEURL; ?>/auth/login"
                            >
                                Login
                            </a>

                        </li>

                    <?php endif; ?>

                </ul>

            </div>

        </div>

    </nav>

    <!-- CONTAINER -->
    <div class="container mt-4">