<h1 class="mb-4">
    Data Mahasiswa
</h1>

<!-- FLASH MESSAGE -->
<?php if (isset($_SESSION['flash'])) : ?>

    <div class="alert alert-<?= $_SESSION['flash']['type'] == 'success'
        ? 'success'
        : 'danger'; ?>">

        <?= $_SESSION['flash']['message']; ?>

    </div>

    <?php unset($_SESSION['flash']); ?>

<?php endif; ?>

<!-- tombol tambah -->
<a
    href="<?= BASEURL; ?>/mahasiswa/create"
    class="btn btn-primary mb-3"
>
    Tambah Mahasiswa
</a>

<!-- FORM SEARCH -->
<form
    method="POST"
    action="<?= BASEURL; ?>/mahasiswa/index"
    class="row g-3 mb-4"
>

    <div class="col-md-4">

        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Cari npm atau nama..."
            value="<?= isset($search) ? $search : ''; ?>"
        >

    </div>

    <div class="col-md-4">

        <select
            name="jurusan"
            class="form-select"
        >

            <option value="">
                Semua Jurusan
            </option>

            <option
                value="Teknik Informatika"
                <?= (isset($jurusan) &&
                    $jurusan == 'Teknik Informatika')
                    ? 'selected'
                    : ''; ?>
            >
                Teknik Informatika
            </option>

            <option
                value="Sistem Informasi"
                <?= (isset($jurusan) &&
                    $jurusan == 'Sistem Informasi')
                    ? 'selected'
                    : ''; ?>
            >
                Sistem Informasi
            </option>

        </select>

    </div>

    <div class="col-md-4">

        <button
            type="submit"
            class="btn btn-success"
        >
            Cari
        </button>

        <a
            href="<?= BASEURL; ?>/mahasiswa/index"
            class="btn btn-secondary"
        >
            Reset
        </a>

    </div>

</form>

<table class="table table-striped table-bordered">

    <thead class="table-dark">

        <tr>

            <th>No</th>
            <th>NPM</th>
            <th>Nama Lengkap</th>
            <th>Fakultas</th>
            <th>Jurusan</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Status</th>
            <th>Aksi</th>

        </tr>

    </thead>

    <tbody>

        <?php $no = 1; ?>

        <?php if (!empty($mahasiswa)) : ?>

            <?php foreach ($mahasiswa as $mhs) : ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td><?= $mhs['npm']; ?></td>

                    <td><?= $mhs['nama_lengkap']; ?></td>

                    <td><?= $mhs['fakultas']; ?></td>

                    <td><?= $mhs['jurusan']; ?></td>

                    <td><?= $mhs['tempat_lahir']; ?></td>

                    <td>
                        <?= date(
                            'd-m-Y',
                            strtotime($mhs['tanggal_lahir'])
                        ); ?>
                    </td>

                    <td><?= $mhs['jenis_kelamin']; ?></td>

                    <td>
                        <?= ($mhs['status_id'] == 1)
                            ? 'Aktif'
                            : 'Nonaktif'; ?>
                    </td>

                    <td>

                        <a
                            href="<?= BASEURL; ?>/mahasiswa/edit/<?= $mhs['id']; ?>"
                            class="btn btn-warning btn-sm"
                        >
                            Edit
                        </a>

                        <a
                            href="<?= BASEURL; ?>/mahasiswa/delete/<?= $mhs['id']; ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin ingin menghapus data ini?')"
                        >
                            Delete
                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else : ?>

            <tr>

                <td colspan="10" class="text-center">

                    Data mahasiswa tidak ditemukan

                </td>

            </tr>

        <?php endif; ?>

    </tbody>

</table>