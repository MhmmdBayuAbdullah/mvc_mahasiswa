<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>

    <style>

        body {
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #dddddd;
        }

        a {
            text-decoration: none;
        }

        .success {
            padding: 10px;
            margin-bottom: 15px;
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            padding: 10px;
            margin-bottom: 15px;
            background-color: #f8d7da;
            color: #721c24;
        }

        .btn {
            padding: 6px 10px;
            border: 1px solid black;
            display: inline-block;
            margin-right: 5px;
        }

    </style>
</head>

<body>

    <h1>Data Mahasiswa</h1>

    <!-- FLASH MESSAGE -->
    <?php if (isset($_SESSION['flash'])) : ?>

        <div class="<?= $_SESSION['flash']['type']; ?>">

            <?= $_SESSION['flash']['message']; ?>

        </div>

        <?php unset($_SESSION['flash']); ?>

    <?php endif; ?>

    <!-- TOMBOL TAMBAH -->
    <p>

        <a
            href="<?= BASEURL; ?>/mahasiswa/create"
            class="btn"
        >
            Tambah Mahasiswa
        </a>

    </p>

    <!-- FORM SEARCH & FILTER -->
    <form
        method="POST"
        action="<?= BASEURL; ?>/mahasiswa/index"
    >

        <input
            type="text"
            name="search"
            placeholder="Cari npm atau nama..."
            value="<?= isset($search) ? $search : ''; ?>"
        >

        <select name="jurusan">

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

        <button type="submit">
            Cari
        </button>

        <a
            href="<?= BASEURL; ?>/mahasiswa/index"
            class="btn"
        >
            Reset
        </a>

    </form>

    <table>

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
                        >
                            Edit
                        </a>

                        |

                        <a
                            href="<?= BASEURL; ?>/mahasiswa/delete/<?= $mhs['id']; ?>"
                            onclick="return confirm('Yakin ingin menghapus data ini?')"
                        >
                            Delete
                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else : ?>

            <tr>

                <td colspan="10">

                    Data mahasiswa tidak ditemukan

                </td>

            </tr>

        <?php endif; ?>

    </table>

</body>
</html>