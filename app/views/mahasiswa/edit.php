<?php
    $mahasiswa = $mahasiswa ?? [];
?>

<h1 class="mb-4">
    Edit Mahasiswa
</h1>

<!-- FLASH MESSAGE -->
<?php if (isset($_SESSION['flash'])) : ?>

    <div class="alert alert-danger">

        <?= $_SESSION['flash']['message']; ?>

    </div>

    <?php unset($_SESSION['flash']); ?>

<?php endif; ?>

<form
    action="<?= BASEURL; ?>/mahasiswa/update/<?= $mahasiswa['id']; ?>"
    method="POST"
>

    <div class="mb-3">

        <label class="form-label">
            NPM
        </label>

        <input
            type="text"
            name="npm"
            class="form-control"
            value="<?= $mahasiswa['npm']; ?>"
            required
        >

    </div>

    <div class="mb-3">

        <label class="form-label">
            Nama Lengkap
        </label>

        <input
            type="text"
            name="nama_lengkap"
            class="form-control"
            value="<?= $mahasiswa['nama_lengkap']; ?>"
            required
        >

    </div>

    <div class="mb-3">

        <label class="form-label">
            Fakultas
        </label>

        <input
            type="text"
            name="fakultas"
            class="form-control"
            value="<?= $mahasiswa['fakultas']; ?>"
        >

    </div>

    <div class="mb-3">

        <label class="form-label">
            Jurusan
        </label>

        <select
            name="jurusan"
            class="form-select"
            required
        >

            <option value="">
                -- Pilih Jurusan --
            </option>

            <option
                value="Teknik Informatika"
                <?= ($mahasiswa['jurusan'] == 'Teknik Informatika')
                    ? 'selected'
                    : ''; ?>
            >
                Teknik Informatika
            </option>

            <option
                value="Sistem Informasi"
                <?= ($mahasiswa['jurusan'] == 'Sistem Informasi')
                    ? 'selected'
                    : ''; ?>
            >
                Sistem Informasi
            </option>

        </select>

    </div>

    <div class="mb-3">

        <label class="form-label">
            Tempat Lahir
        </label>

        <input
            type="text"
            name="tempat_lahir"
            class="form-control"
            value="<?= $mahasiswa['tempat_lahir']; ?>"
        >

    </div>

    <div class="mb-3">

        <label class="form-label">
            Tanggal Lahir
        </label>

        <input
            type="date"
            name="tanggal_lahir"
            class="form-control"
            value="<?= $mahasiswa['tanggal_lahir']; ?>"
        >

    </div>

    <div class="mb-3">

        <label class="form-label d-block">
            Jenis Kelamin
        </label>

        <div class="form-check form-check-inline">

            <input
                class="form-check-input"
                type="radio"
                name="jenis_kelamin"
                value="Laki-laki"
                <?= ($mahasiswa['jenis_kelamin'] == 'Laki-laki')
                    ? 'checked'
                    : ''; ?>
            >

            <label class="form-check-label">
                Laki-laki
            </label>

        </div>

        <div class="form-check form-check-inline">

            <input
                class="form-check-input"
                type="radio"
                name="jenis_kelamin"
                value="Perempuan"
                <?= ($mahasiswa['jenis_kelamin'] == 'Perempuan')
                    ? 'checked'
                    : ''; ?>
            >

            <label class="form-check-label">
                Perempuan
            </label>

        </div>

    </div>

    <button
        type="submit"
        class="btn btn-primary"
    >
        Update
    </button>

    <a
        href="<?= BASEURL; ?>/mahasiswa/index"
        class="btn btn-secondary"
    >
        Kembali
    </a>

</form>