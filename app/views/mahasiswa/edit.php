<!DOCTYPE html>
<html>
<head>
    <title>Edit Mahasiswa</title>
</head>

<body>
    
    <?php $mahasiswa = $mahasiswa ?? []; ?>

    <h1>Edit Mahasiswa</h1>

    <?php $this->flash(); ?>

    <form
        action="<?= BASEURL; ?>/mahasiswa/update/<?= $mahasiswa['id']; ?>"
        method="POST"
    >

        <p>
            NPM <br>

            <input
                type="text"
                name="npm"
                value="<?= $mahasiswa['npm']; ?>"
            >
        </p>

        <p>
            Nama Lengkap <br>

            <input
                type="text"
                name="nama_lengkap"
                value="<?= $mahasiswa['nama_lengkap']; ?>"
            >
        </p>

        <p>
            Fakultas <br>

            <input
                type="text"
                name="fakultas"
                value="<?= $mahasiswa['fakultas']; ?>"
            >
        </p>

        <p>
            Jurusan <br>

            <select name="jurusan">

                <option
                    value="Teknik Informatika"
                    <?= $mahasiswa['jurusan'] == 'Teknik Informatika' ? 'selected' : ''; ?>
                >
                    Teknik Informatika
                </option>

                <option
                    value="Sistem Informasi"
                    <?= $mahasiswa['jurusan'] == 'Sistem Informasi' ? 'selected' : ''; ?>
                >
                    Sistem Informasi
                </option>

            </select>
        </p>

        <p>
            Tempat Lahir <br>

            <input
                type="text"
                name="tempat_lahir"
                value="<?= $mahasiswa['tempat_lahir']; ?>"
            >
        </p>

        <p>
            Tanggal Lahir <br>

            <input
                type="date"
                name="tanggal_lahir"
                value="<?= $mahasiswa['tanggal_lahir']; ?>"
            >
        </p>

        <p>
            Jenis Kelamin <br>

            <input
                type="radio"
                name="jenis_kelamin"
                value="Laki-laki"
                <?= $mahasiswa['jenis_kelamin'] == 'Laki-laki' ? 'checked' : ''; ?>
            >
            Laki-laki

            <input
                type="radio"
                name="jenis_kelamin"
                value="Perempuan"
                <?= $mahasiswa['jenis_kelamin'] == 'Perempuan' ? 'checked' : ''; ?>
            >
            Perempuan
        </p>

        <button type="submit">
            Update
        </button>

    </form>

</body>
</html>