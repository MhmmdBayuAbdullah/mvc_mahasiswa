<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mahasiswa</title>
</head>

<body>

    <h1>Tambah Mahasiswa</h1>

    <?php $this->flash(); ?>

<p>
    <a href="<?= BASEURL; ?>/mahasiswa/create">
        Tambah Mahasiswa
    </a>
</p>

    <form action="<?= BASEURL; ?>/mahasiswa/store" method="POST">

        <p>
            NPM <br>
            <input type="text" name="npm">
        </p>

        <p>
            Nama Lengkap <br>
            <input type="text" name="nama_lengkap">
        </p>

        <p>
            Fakultas <br>
            <input type="text" name="fakultas">
        </p>

        <p>
            Jurusan <br>

            <select name="jurusan">

                <option value="Teknik Informatika">
                    Teknik Informatika
                </option>

                <option value="Sistem Informasi">
                    Sistem Informasi
                </option>

            </select>
        </p>

        <p>
            Tempat Lahir <br>
            <input type="text" name="tempat_lahir">
        </p>

        <p>
            Tanggal Lahir <br>
            <input type="date" name="tanggal_lahir">
        </p>

        <p>
            Jenis Kelamin <br>

            <input
                type="radio"
                name="jenis_kelamin"
                value="Laki-laki"
            >
            Laki-laki

            <input
                type="radio"
                name="jenis_kelamin"
                value="Perempuan"
            >
            Perempuan
        </p>

        <button type="submit">
            Simpan
        </button>

    </form>

</body>
</html>